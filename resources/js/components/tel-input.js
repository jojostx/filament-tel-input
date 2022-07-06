import intlTelInput from "intl-tel-input";
import "intl-tel-input/build/css/intlTelInput.css";

window.intlTelInput = intlTelInput;

export default (Alpine) => {
    Alpine.data(
        "TelInputFormComponent",
        ({
            autodetect,
            excludeCountries,
            initialCountry,
            onlyCountries,
            placeholder,
            preferredCountries,
            state,
        }) => {
            return {
                state,

                init: function () {
                    const telInput = this.$refs.telInput;

                    this.initTelInput(telInput, {
                        excludeCountries,
                        initialCountry,
                        onlyCountries,
                        preferredCountries: this.getPreferredCountries(),
                        geoIpLookup: initialCountry == "auto" ? "ipinfo" : null,
                        customPlaceholder: this.getPlaceholder,
                        nationalMode: autodetect ? true : false,
                        separateDialCode: autodetect ? false : true,
                        utilsScript:
                            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.17/js/utils.min.js",
                    });
                },

                initTelInput: function (telInput, options = {}) {
                    const IntlTelInputSelectedCountryCookie =
                        this.getCookieName(telInput.id);

                    // fix autofill bugs on page refresh in Firefox
                    telInput
                        .closest("form")
                        ?.setAttribute("autocomplete", "off");

                    // geoIpLookup option
                    if (options.geoIpLookup == null) {
                        // unset it if null
                        delete options.geoIpLookup;
                    } else if (options.geoIpLookup === "ipinfo") {
                        options.geoIpLookup = (success, failure) => {
                            let country = this.getCountryFromCookie(
                                IntlTelInputSelectedCountryCookie
                            );
                            if (country) {
                                success(country);
                            } else {
                                fetch("https://ipinfo.io/json")
                                    .then((res) => res.json())
                                    .then((data) => data)
                                    .then((data) => {
                                        let country =
                                            data.country?.toUpperCase();
                                        success(country);
                                        this.setCountryCookie(
                                            IntlTelInputSelectedCountryCookie,
                                            country
                                        );
                                    })
                                    .catch(() => success("NG"));
                            }
                        };
                    }

                    // init the tel input
                    intlTelInput(telInput, options).setNumber(this.state);
                },

                getPlaceholder: function (
                    selectedCountryPlaceholder,
                    selectedCountryData
                ) {
                    if (
                        placeholder === null ||
                        placeholder === undefined ||
                        (typeof placeholder === "string" && placeholder === "")
                    ) {
                        return "ex: " + selectedCountryPlaceholder;
                    }

                    let countryData = Object.keys(selectedCountryData);

                    countryData.forEach((element) => {
                        placeholder = placeholder.replace(
                            ":selectedCountryData." + element,
                            selectedCountryData[element]
                        );
                    });

                    return placeholder.replace(
                        ":selectedCountry.phone",
                        selectedCountryPlaceholder
                    );
                },

                getPreferredCountries: function () {
                    if (
                        Array.isArray(preferredCountries) &&
                        Array.isArray(excludeCountries) &&
                        Array.isArray(onlyCountries)
                    ) {
                        return preferredCountries.filter((country) => {
                            return (
                                onlyCountries.includes(country) &&
                                !excludeCountries.includes(country)
                            );
                        });
                    }

                    return [initialCountry];
                },

                getCookieName: function (id) {
                    return `IntlTelInputSelectedCountry_${id}`;
                },

                getCountryFromCookie: function (cookieName) {
                    let name = cookieName + "=";
                    let ca = document.cookie.split(";");
                    for (let i = 0; i < ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == " ") {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                },

                removeCountryCookie: function (
                    cookieName,
                    path = null,
                    domain = null
                ) {
                    let cookieString = `${cookieName}=;`;
                    const d = new Date();
                    d.setTime(d.getTime() - 30 * 24 * 60 * 60 * 1000);
                    cookieString += `expires=${d.toUTCString()};`;
                    if (path) {
                        cookieString += `path=${path};`;
                    }
                    if (domain) {
                        cookieString += `domain=${domain};`;
                    }
                    document.cookie = cookieString;
                },

                setCountryCookie: function (
                    cookieName,
                    cookieValue,
                    expiryDays = null,
                    path = null,
                    domain = null
                ) {
                    let cookieString = `${cookieName}=${cookieValue};`;
                    if (expiryDays) {
                        const d = new Date();
                        d.setTime(
                            d.getTime() + expiryDays * 24 * 60 * 60 * 1000
                        );
                        cookieString += `expires=${d.toUTCString()};`;
                    }
                    if (path) {
                        cookieString += `path=${path};`;
                    }
                    if (domain) {
                        cookieString += `domain=${domain};`;
                    }
                    document.cookie = cookieString;
                },

                setState: function () {
                    let telInput = this.$refs.telInput;
                    let itiPhone =
                        window.intlTelInputGlobals.getInstance(telInput);

                    if (!itiPhone) {
                        return;
                    }

                    this.setCountryCookie(
                        this.getCookieName(telInput.id),
                        itiPhone.getSelectedCountryData().iso2?.toUpperCase()
                    );

                    if (itiPhone.isValidNumber()) {
                        this.state = itiPhone.getNumber();

                        return;
                    }

                    if (
                        telInput.value != "" &&
                        telInput.value.charAt(0) != "+" &&
                        telInput.value.charAt(0) != "0"
                    ) {
                        this.state =
                            "+" +
                            itiPhone.getSelectedCountryData().dialCode +
                            telInput.value;
                    } else {
                        this.state = telInput.value;
                    }
                },
            };
        }
    );
};

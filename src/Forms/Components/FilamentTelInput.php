<?php

namespace Jojostx\FilamentTelInput\Components;

use Closure;
use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Field;
use Filament\Support\Concerns\HasExtraAlpineAttributes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\Rule;
use libphonenumber\PhoneNumberType;
use Propaganistas\LaravelPhone\Rules\Phone;

class FilamentTelInput extends Field
{
    use Concerns\CanBeAutocompleted;
    use Concerns\CanBeLengthConstrained;
    use Concerns\HasAffixes;
    use Concerns\HasExtraInputAttributes;
    use Concerns\HasPlaceholder;
    use HasExtraAlpineAttributes;

    protected string $view = 'filament-tel-input::forms.components.phone-number-input';

    protected array | Arrayable | Closure | null $allowedCountries = [];
    protected array | Arrayable | Closure | null $excludeCountries = [];
    protected string | Closure | null $initialCountry = '';
    protected string | Closure | null $numberType = null;
    protected bool | Closure $isAutoDetected = true;
    protected bool | Closure $isLenient = false;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule(static function (FilamentTelInput $component) {
            /**
             * @var Phone $rule
             */
            $rule = Rule::phone();

            $rule->country($component->getAllowedCountries());

            if (! blank($component->getNumberType())) {
                $rule->type($component->getNumberType());
            }

            if ($component->isLenient()) {
                $rule->detect();
            }

            if ($component->isAutoDetected()) {
                $rule->lenient();
            }

            return $rule;
        });
    }

    // ---- setters ---- //
    public function allowedCountries(array | Arrayable | Closure | null $countries): static
    {
        $this->allowedCountries = $countries;

        return $this;
    }

    public function autoDetect(bool | Closure $condition = true): static
    {
        $this->isAutoDetected = $condition;

        return $this;
    }

    public function excludeCountries(array | Arrayable | Closure | null $countries): static
    {
        $this->excludeCountries = $countries;

        return $this;
    }

    public function initialCountry(string | Closure | null $country): static
    {
        $this->initialCountry = $country;

        return $this;
    }

    public function lenient(bool | Closure $condition = true): static
    {
        $this->isLenient = $condition;

        return $this;
    }

    public function numberType(string | Closure | null $numberType): static
    {
        $this->numberType = $numberType;

        return $this;
    }

    // ---- getters ---- //
    public function getAllowedCountries(): array
    {
        $countries = $this->evaluate($this->allowedCountries);

        if ($countries instanceof Arrayable) {
            $countries = $countries->toArray();
        }

        if ((is_array($countries) && blank($countries)) || ! is_array($countries)) {
            $countries = ['US'];
        }

        $this->excludeCountries(['']);

        return $countries;
    }

    public function getExcludeCountries(): ?array
    {
        $excludeCountries = $this->evaluate($this->excludeCountries);

        if ($excludeCountries instanceof Arrayable) {
            $excludeCountries = $excludeCountries->toArray();
        }

        if (blank($excludeCountries)) {
            $excludeCountries = [];
        }

        $this->allowedCountries(['']);

        return $excludeCountries;
    }

    public function getInitialCountry(): ?string
    {
        $country = $this->evaluate($this->initialCountry);

        if (blank($country) || ! in_array($country, $this->getAllowedCountries()) || in_array($country, $this->getExcludeCountries())) {
            $country = $this->getAllowedCountries()[0] ?: 'US';
        }

        return $country;
    }

    public function getNumberType(): ?string
    {
        $numberType = $this->evaluate($this->numberType);

        if (
      ! is_string($numberType) ||
      (is_string($numberType) && ! in_array($numberType, PhoneNumberType::values()))
    ) {
            return null;
        }

        return $numberType;
    }

    public function isAutoDetected(): bool
    {
        return (bool) $this->evaluate($this->isAutoDetected);
    }

    public function isLenient(): bool
    {
        return (bool) $this->evaluate($this->isLenient);
    }
}

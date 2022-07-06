import TelInputAlpineComponent from './components/tel-input';

document.addEventListener('alpine:init', () => {
    window.Alpine.plugin(TelInputAlpineComponent);
})
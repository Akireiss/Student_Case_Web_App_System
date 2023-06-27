function data() {
    function getThemeFromLocalStorage() {
      // If the user has already changed the theme, use it
      if (window.localStorage.getItem('dark')) {
        return JSON.parse(window.localStorage.getItem('dark'));
      }

      // Otherwise, return their preferences
      return (
        !!window.matchMedia &&
        window.matchMedia('(prefers-color-scheme: dark)').matches
      );
    }

    function setThemeToLocalStorage(value) {
      window.localStorage.setItem('dark', value);
    }

    return {
      dark: getThemeFromLocalStorage(),
      toggleTheme() {
        this.dark = !this.dark;
        setThemeToLocalStorage(this.dark);
      },
      // Your existing methods and properties here
    };
  }

  // Initialize Alpine.js
  Alpine.data('myComponent', data);

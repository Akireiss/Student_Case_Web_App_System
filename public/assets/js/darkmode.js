const bodyTag = document.querySelector('html');

function data() {
	function getThemeFromLocalStorage() {
		// if user already changed the theme, use it
		if (window.localStorage.getItem('dark')) {
			return JSON.parse(window.localStorage.getItem('dark'))
		}

		// else return their preferences
		return (
			!!window.matchMedia &&
			window.matchMedia('(prefers-color-scheme: dark)').matches
		)
	}

	function setThemeToLocalStorage(value) {
		window.localStorage.setItem('dark', value)
	}

	function setTheme(value) {
		if (value) {
			bodyTag.classList.add('dark');
		} else {
			bodyTag.classList.remove('dark');
		}
	}

	setTheme(getThemeFromLocalStorage());

	return {
		dark: getThemeFromLocalStorage(),
		toggleTheme() {
			this.dark = !this.dark
			setTheme(this.dark);
			setThemeToLocalStorage(this.dark)
		},

	}
}

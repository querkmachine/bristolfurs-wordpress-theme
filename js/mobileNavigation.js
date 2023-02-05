class MobileNavigation {
	constructor() {
		// Define some variables
		this.toggleId = "nav-toggle"
		this.navId = "nav-menu"
		this.mq = window.matchMedia("(min-width: 768px)") // 'gamma' breakpoint in Sass

		// Get our elements
		this.$toggleButton = document.getElementById(this.toggleId)
		this.$navigation = document.getElementById(this.navId)

		// If either thing is missing, stop!
		if (!this.$toggleButton || !this.$navigation) {
			return
		}

		// Our mobile nav only has to do anything on mobile, so keep an eye on the
		// viewport size: If it's small, build. If it's large, destroy.
		this.checkMediaQuery()
		this.mq.addEventListener("change", this.checkMediaQuery.bind(this))
	}
	checkMediaQuery() {
		if (this.mq.matches) {
			this.destroy()
		} else {
			this.build()
		}
	}
	build() {
		// Do some funky things for accessibility's sakes
		this.$navigation.setAttribute("aria-controlledby", this.toggleId)
		this.$navigation.setAttribute("hidden", "hidden")
		this.$toggleButton.setAttribute("aria-controls", this.navId)
		this.$toggleButton.setAttribute("aria-expanded", "false")
		this.$toggleButton.removeAttribute("hidden")

		// Bind click event
		this.$toggleButton.bindClick = this.toggleMenu.bind(this)
		this.$toggleButton.addEventListener("click", this.$toggleButton.bindClick)
	}
	destroy() {
		// Undo some funky things for accessibility's sakes
		this.$navigation.removeAttribute("aria-controlledby")
		this.$navigation.removeAttribute("hidden")
		this.$toggleButton.removeAttribute("aria-controls")
		this.$toggleButton.removeAttribute("aria-expanded")
		this.$toggleButton.setAttribute("hidden", "hidden")

		// Unbind click event
		this.$toggleButton.removeEventListener(
			"click",
			this.$toggleButton.bindClick
		)
	}
	toggleMenu() {
		if (this.$toggleButton.getAttribute("aria-expanded") === "false") {
			this.showMenu()
			return
		}
		this.hideMenu()
	}
	showMenu() {
		this.$toggleButton.setAttribute("aria-expanded", "true")
		this.$navigation.removeAttribute("hidden")
	}
	hideMenu() {
		this.$toggleButton.setAttribute("aria-expanded", "false")
		this.$navigation.setAttribute("hidden", "hidden")
	}
}

new MobileNavigation()

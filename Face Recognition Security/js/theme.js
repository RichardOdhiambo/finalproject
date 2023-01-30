class MyHeader extends HTMLElement{
	connectedCallback(){
		this.innerHTML = '<header>please work</header>'
	}
}

customElements.define ('my-header', MyHeader)
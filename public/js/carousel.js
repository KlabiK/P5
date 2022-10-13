class Carousel {

    constructor (element, options = {}) {
        this.element = element
        this.options = Object.assign({}, {
            slidesToScroll: 1,
            slidesVisible: 1
        },options)
        let children = [].slice.call (element.children)
        this.currentItem = 0
        this.moveCallbacks = []

        //Modifications du DOM

        this.root = this.createDivWithClass('carousel')
        this.container = this.createDivWithClass('carousel_container')
        this.root.setAttribute('tabindex', '0')
        this.root.appendChild(this.container)
        this.element.appendChild(this.root)
        this.items = children.map((child) => {
            let item = this.createDivWithClass('carousel_item') 
            item.appendChild(child)
            this.container.appendChild(item)
            return item
        })
        this.slidePlay()
        this.setStyle()
        this.auto
        this.createNavigation()

        //Events

        this.moveCallbacks.forEach(cb => cb(0))
        this.root.addEventListener('keyup', e => { //mise en place navigation via clavier pour le carousel
            if (e.key === 'ArrowRight' || e.key === 'Right') {
                this.next()
            }else if (e.key === 'ArrowLeft' || e.key === 'Left') {
                this.prev()
            }
        })
    }

    /**
     * Dimensionne elements du carousel
     */
    setStyle () {
        let ratio = this.items.length / this.options.slidesVisible
        this.container.style.width = (ratio * 100) + "%"
        this.items.forEach( item => item.style.width = ((100 / this.options.slidesVisible) / ratio) + "%")
    }
    createNavigation () {
        let nextButton = this.createDivWithClass('carousel_next')
        let prevButton = this.createDivWithClass('carousel_prev')
        this.root.appendChild(nextButton)
        this.root.appendChild(prevButton)
        nextButton.addEventListener('click', this.next.bind(this))
        prevButton.addEventListener('click', this.prev.bind(this))
    }
    next() {
        this.gotoItem(this.currentItem + this.options.slidesToScroll)
    }
    prev() {
        this.gotoItem(this.currentItem - this.options.slidesToScroll)
    }
    slidePlay() {
        this.auto = setInterval(this.next.bind(this), 5000)
    }
    /**
     * 
     * @param {Number} index 
     */
    gotoItem(index) {
        if(index < 0) {
            index = this.items.length - this.options.slidesVisible
        } else if (index >= this.items.length || (this.items[ this.currentItem + this.options.slidesVisible] === undefined && index > this.currentItem)) {
            index = 0
        }
        let translateX = index * -100 / this.items.length
        this.container.style.transform = 'translate3d(' + translateX + '%,0,0)'
        this.currentItem = index
        this.moveCallbacks.forEach(cb => cb(index))
    }

    onMove (cb) {
        this.moveCallbacks.push(cb)
    }

    createDivWithClass (className) {
        let div = document.createElement('div')
        div.setAttribute('class', className)
        return div
    }

}
document.addEventListener('DOMContentLoaded', function() {
    new Carousel(document.querySelector('#carousel1'), {
        slidesToScroll: 1,
        slidesVisible: 1,
    })
})
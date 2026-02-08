import Alpine from 'alpinejs'
import '../css/app.css'

window.Alpine = Alpine

Alpine.start()

// Global utilities
window.formatCurrency = (amount) => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'NGN'
  }).format(amount)
}

// image preview
alert('juice')

# Digital Horizon Invoices

A dead-simple invoice generator for freelancers and small businesses built with Laravel Blade, TailwindCSS, and Alpine.js.

## Features

- **Instant Invoice Creation** - Create professional invoices in seconds
- **One-Click Sending** - Send invoices directly to clients via email
- **Payment Tracking** - Track invoice status in real-time
- **Online Payments** - Accept payments directly through invoices
- **Professional Templates** - Beautiful, customizable invoice templates
- **Client Management** - Organize all your clients in one place

## Tech Stack

- **Laravel Blade** - Server-side templating
- **TailwindCSS 4** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Vite** - Next-generation frontend build tool

## Project Structure

```
digital-horizon-invoices-blade/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   ├── app.blade.php          # Main dashboard layout
│   │   │   └── landing.blade.php      # Landing page layout
│   │   ├── components/
│   │   │   ├── navbar.blade.php       # Navigation bar
│   │   │   ├── sidebar.blade.php      # Sidebar navigation
│   │   │   ├── topbar.blade.php       # Top bar
│   │   │   ├── footer.blade.php       # Footer
│   │   │   ├── stat-card.blade.php    # Statistics card
│   │   │   ├── feature-card.blade.php # Feature card
│   │   │   ├── pricing-card.blade.php # Pricing card
│   │   │   └── faq-item.blade.php     # FAQ item
│   │   └── pages/
│   │       ├── landing.blade.php      # Landing page
│   │       ├── dashboard.blade.php    # Dashboard
│   │       ├── invoices.blade.php     # Invoices list
│   │       ├── clients.blade.php      # Clients management
│   │       └── settings.blade.php     # Settings
│   ├── css/
│   │   └── app.css                    # Global styles
│   └── js/
│       └── app.js                     # Global JavaScript
├── package.json
├── vite.config.js
├── tailwind.config.js
├── postcss.config.js
└── README.md
```

## Installation

1. **Install dependencies**
   ```bash
   npm install
   ```

2. **Start development server**
   ```bash
   npm run dev
   ```

3. **Build for production**
   ```bash
   npm run build
   ```

The development server will start at `http://localhost:5173`

## Pages

### Landing Page
- Hero section with value proposition
- Features showcase (6 cards)
- How it works (3 steps)
- Pricing section (Free & Pro plans)
- Testimonials
- FAQ with Alpine.js accordion
- Call-to-action sections

### Dashboard
- Key metrics (Total Revenue, Outstanding, Active Clients, Avg. Payment Time)
- Recent invoices table
- Quick navigation to other sections

### Invoices
- List of all invoices with search
- Invoice status badges (Paid, Pending, Overdue)
- Pagination
- Quick actions menu

### Clients
- Client list with contact information
- Total invoices and billing amount per client
- Add/Edit client functionality

### Settings
- Business profile management
- Logo upload
- Invoicing preferences
- Currency and tax rate configuration
- Bank information

## Customization

### Colors
Edit `tailwind.config.js` to customize the primary color:
```javascript
colors: {
  primary: '#2563eb',        // Change this
  'primary-dark': '#1e40af',
  'primary-light': '#3b82f6'
}
```

### Typography
Modify font family in `tailwind.config.js`:
```javascript
fontFamily: {
  sans: ['Inter', 'system-ui', 'sans-serif']  // Change this
}
```

### Components
All reusable components are in `resources/views/components/`. Edit them to match your design.

## Blade Components

### stat-card
```blade
@include('components.stat-card', [
    'label' => 'Total Revenue',
    'value' => '$45,231.89',
    'change' => 12.5,
    'icon' => '<svg>...</svg>',
    'iconBg' => 'bg-emerald-50'
])
```

### feature-card
```blade
@include('components.feature-card', [
    'title' => 'Feature Title',
    'description' => 'Feature description',
    'icon' => '<svg>...</svg>'
])
```

### pricing-card
```blade
@include('components.pricing-card', [
    'name' => 'Pro',
    'description' => 'For growing businesses',
    'price' => '29',
    'featured' => true,
    'features' => ['Feature 1', 'Feature 2'],
    'cta' => 'Start Free Trial'
])
```

### faq-item
```blade
@include('components.faq-item', [
    'question' => 'How does it work?',
    'answer' => 'Answer text here...'
])
```

## Alpine.js Features

- FAQ accordion toggle
- Mobile navigation (ready to implement)
- Form interactions

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

MIT License - feel free to use this project for personal or commercial purposes.

## Support

For issues or questions, please refer to the documentation or create an issue in the repository.

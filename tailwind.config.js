/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1E3A8A',       // Bleu foncé - boutons / éléments actifs
        secondary: '#3B82F6',     // Bleu clair - hover / accent
        danger: '#DC2626',        // Rouge - suppression / alertes
        graybg: '#F3F4F6',        // Fond clair
        text: {
          primary: '#111827',     // Texte sombre
          secondary: '#6B7280',   // Texte gris secondaire
        },
      },
      fontFamily: {
        sans: ['Figtree', 'Inter', 'Roboto', 'ui-sans-serif', 'system-ui'],
      },
    },
  },
  plugins: [],
}

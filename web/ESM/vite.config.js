// vite.config.js
import { defineConfig } from 'vite';

export default defineConfig({
  css: {
    postcss: './postcss.config.cjs', // Reference the renamed PostCSS config file
  },
});

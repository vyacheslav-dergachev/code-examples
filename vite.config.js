import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import symfonyPlugin from 'vite-plugin-symfony';
import { resolve } from 'path';
import { fileURLToPath, URL } from 'node:url';

export default defineConfig({
  plugins: [
    react({
      jsxRuntime: 'automatic',
    }),
    symfonyPlugin({
      // Symfony public directory
      publicDirectory: 'public',
      // Build directory inside public
      buildDirectory: 'build',
    }),
  ],

  // Define entry points
  build: {
    rollupOptions: {
      input: {
        // Main app entry point
        app: resolve(fileURLToPath(new URL('.', import.meta.url)), 'assets/app.js'),
        // React app entry point
        react: resolve(fileURLToPath(new URL('.', import.meta.url)), 'assets/src/main.tsx'),
      },
    },
    // Output directory
    outDir: 'public/build',
    // Generate manifest for Symfony
    manifest: true,
    // Clean output directory before build
    emptyOutDir: true,
  },

  // Development server configuration
  server: {
    host: '0.0.0.0',
    port: 3000,
    // Enable HMR
    hmr: {
      port: 3000,
    },
    // CORS for Symfony integration
    cors: {
      origin: ['http://localhost', 'http://localhost:80', 'http://127.0.0.1', 'http://code-examples.localhost'],
      credentials: true,
    },
  },

  // Resolve configuration
  resolve: {
    alias: {
      '@': resolve(fileURLToPath(new URL('.', import.meta.url)), 'assets/src'),
      '~': resolve(fileURLToPath(new URL('.', import.meta.url)), 'assets'),
    },
  },

  // CSS configuration - let PostCSS handle Tailwind
  css: {
    postcss: './postcss.config.js',
  },

  // Base URL for assets
  base: '/',
});

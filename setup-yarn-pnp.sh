#!/bin/bash

# Setup script for Yarn PnP with TypeScript
echo "Setting up Yarn PnP for TypeScript..."

# Install TypeScript plugin for Yarn
yarn plugin import typescript

# Generate TypeScript SDK for PnP
yarn dlx @yarnpkg/sdks vscode

echo "Setup complete! Please restart your IDE/TypeScript service."

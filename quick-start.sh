#!/bin/bash

echo "=========================================="
echo "  Personal Portfolio - Quick Start"
echo "=========================================="
echo ""

check_docker() {
    if ! command -v docker &> /dev/null; then
        echo "❌ Docker is not installed."
        echo "Please install Docker from: https://www.docker.com/products/docker-desktop"
        exit 1
    fi
    echo "✅ Docker is installed"
}

check_docker_compose() {
    if ! command -v docker-compose &> /dev/null; then
        echo "❌ Docker Compose is not installed."
        echo "Please install Docker Compose"
        exit 1
    fi
    echo "✅ Docker Compose is installed"
}

echo "Checking prerequisites..."
check_docker
check_docker_compose

echo ""
echo "Starting WordPress with Docker..."
docker-compose up -d

echo ""
echo "⏳ Waiting for WordPress to initialize (30 seconds)..."
sleep 30

echo ""
echo "=========================================="
echo "  ✅ WordPress is ready!"
echo "=========================================="
echo ""
echo "📍 Your portfolio: http://localhost:8080"
echo "🔐 Admin panel: http://localhost:8080/wp-admin"
echo "💾 Database admin: http://localhost:8081"
echo ""
echo "Next steps:"
echo "1. Open http://localhost:8080 in your browser"
echo "2. Complete the WordPress installation"
echo "3. Login to WordPress admin"
echo "4. Go to Appearance → Themes → Activate 'Personal Portfolio'"
echo "5. Create pages 'Login' and 'New Post' with respective templates"
echo "6. Go to Settings → Permalinks → Select 'Post name'"
echo "7. Visit your site and click 'Login' to start posting!"
echo ""
echo "To stop WordPress: docker-compose down"
echo "To view logs: docker-compose logs -f"
echo ""

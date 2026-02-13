# Plan de Implementación - Tienda Online Textil (Headless)

## Descripción del Objetivo
Desarrollar una tienda en línea moderna para la venta de productos textiles con una arquitectura desacoplada:
- **Backend (API)**: Laravel (carpeta existente `isa`). Se encargará de la lógica de negocio, base de datos y gestión de pedidos.
- **Frontend (SPA)**: React (nueva carpeta `frontend`). Proveerá una interfaz de usuario rica, dinámica y moderna.

## Arquitectura del Proyecto
```
ProyectoIsa/
├── isa/ (Backend Laravel)
│   ├── routes/api.php
│   ├── app/Models/
│   └── ...
└── frontend/ (Frontend React - Vite)
    ├── src/
    │   ├── components/
    │   ├── pages/
    │   └── ...
    └── package.json
```

## Cambios Propuestos

### Backend (Laravel) - Carpeta `isa`
1.  **Base de Datos**:
    - Migraciones para: `categories`, `products`, `orders`, `order_items`.
2.  **API REST**:
    - Endpoints para listar productos, ver detalles y crear pedidos.
    - Configuración de CORS para permitir peticiones desde el frontend React.

### Frontend (React) - Carpeta `frontend`
1.  **Tecnologías**: React, Vite, TailwindCSS (para diseño moderno), React Router.
2.  **Estructura de Páginas**:
    - `HomePage`: Banner principal, productos destacados.
    - `ProductCatalog`: Listado con filtros.
    - `ProductDetail`: Vista individual con selección de talla/color.
    - `Cart/Checkout`: Resumen de compra simplificado.

## Próximos Pasos
1.  **Inicialización Frontend**: Crear el proyecto React con Vite.
2.  **Base de Datos**: Definir el esquema en Laravel.
3.  **Conexión**: Asegurar que el frontend pueda consumir datos del backend.

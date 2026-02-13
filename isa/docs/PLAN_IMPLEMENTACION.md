# Plan de Implementación - Tienda Online Textil

## Descripción del Objetivo
Desarrollar una tienda en línea moderna para la venta de productos textiles (vestidos, ropa, etc.). El sistema permitirá a los clientes navegar por un catálogo, agregar productos al carrito y realizar pedidos. Incluirá un panel administrativo para gestionar productos y ventas.

## Revisión del Usuario Requerida
> [!IMPORTANT]
> **Pasarela de Pago**: Por ahora, el checkout será simulado o "Pago contra entrega" para facilitar el desarrollo inicial. ¿Estás de acuerdo o necesitas integrar Stripe/PayPal desde el inicio?

## Arquitectura de Datos Propuesta
- **Usuarios**: Clientes y Administradores.
- **Categorías**: Tipos de ropa (Vestidos, Blusas, Pantalones).
- **Productos**: Nombre, descripción, precio, stock, imagen, talla, color.
- **Pedidos**: Registro de compras realizadas.
- **Items de Pedido**: Detalle de productos en cada pedido.

## Cambios Propuestos

### Base de Datos
#### [NUEVO] Migraciones
- `create_categories_table`
- `create_products_table`
- `create_orders_table`
- `create_order_items_table`

### Frontend (Vistas)
- `welcome.blade.php`: Página de inicio con productos destacados.
- `products.index`: Catálogo completo con filtros.
- `products.show`: Detalle de producto individual.
- `cart.index`: Vista del carrito de compras.
- `checkout.index`: Formulario de finalización de compra.

## Próximos Pasos
1.  **Aprobación**: Confirmar este plan.
2.  **Modelado**: Crear migraciones y modelos.
3.  **Interfaz**: Crear la estructura visual de la tienda.

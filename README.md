# Clima Pro · Catálogo WordPress + WooCommerce

Sitio catálogo para **Clima Pro**: insumos y herramientas para climatización, electrodomésticos nuevos de línea blanca y comercial, y servicio técnico. **No hay carrito, checkout ni pagos**: cada producto y cada servicio tiene un botón que abre WhatsApp con un mensaje prellenado.

> Mensaje de producto: `Hola, me interesa el producto: [nombre] - Precio: [precio]`

## Contenido del repositorio

```
clima-pro/
├── README.md
├── sample-data/
│   └── productos-muestra.csv      # 8 productos de ejemplo para el importador de WooCommerce
└── theme/clima-pro/               # Theme (se sube a wp-content/themes/clima-pro)
    ├── style.css                  # Cabecera del theme
    ├── functions.php              # Carga los módulos de inc/
    ├── header.php / footer.php    # Encabezado azul, buscador, WhatsApp, menú, beneficios y pie
    ├── front-page.php             # Inicio: hero, secciones, banners, destacados
    ├── woocommerce.php            # Tienda, categorías (con filtros) y ficha de producto
    ├── page.php, index.php, 404.php, searchform.php
    ├── page-templates/
    │   ├── template-servicios.php # Página Servicios (tarjetas + "Pedir presupuesto")
    │   └── template-contacto.php  # Página Contacto (datos + WhatsApp + mapa opcional)
    ├── inc/
    │   ├── theme-setup.php        # Soportes, menús, barra lateral de filtros
    │   ├── assets.php             # CSS/JS y favicon
    │   ├── customizer.php         # WhatsApp, contacto, redes (Personalizador)
    │   ├── whatsapp.php           # Links wa.me, botón, shortcode y botón flotante
    │   ├── catalog-mode.php       # Sin carrito/checkout, redirecciones, botones WhatsApp
    │   ├── woocommerce.php        # Escala: paginación, filtros, subcategorías, lazy load
    │   ├── template-tags.php      # Helpers, íconos, datos de servicios
    │   └── one-click-setup.php    # Apariencia > Clima Pro (configuración en un clic)
    └── assets/
        ├── css/main.css           # Estilos + animaciones (respeta "reducir movimiento")
        ├── js/main.js             # Menú móvil, filtros y aparición al hacer scroll (sin jQuery)
        └── img/
            ├── logo-clima-pro.svg/.png       # Logo para fondo azul (encabezado y pie)
            ├── logo-clima-pro-dark.svg/.png  # Logo para fondo claro
            ├── favicon.svg, placeholder.svg, icons/*.svg
            ├── hero.webp, banner-*.webp      # Fotos del inicio
            ├── products/*.webp + *.jpg       # Fotos de producto (webp para la web, jpg para la Biblioteca de medios)
            └── services/*.webp               # Fotos de las tarjetas de Servicios
```

**Theme independiente (no es child theme):** no depende de Astra ni GeneratePress. Así hay un solo theme para instalar y actualizar, sin riesgo de que un cambio del theme padre rompa el diseño, y carga menos CSS/JS.

## Secciones (menú principal)

1. **Insumos** – Compresores, Piezas mecánicas, Cables, Electrónica, Afines a climatización.
2. **Servicios** – Aire acondicionado, Heladera familiar y comercial, Lavarropas automático (instalación y reparación) y Hogar (cerrajería, construcción en general, durlock y pintura, plomería, electricidad).
3. **Herramientas** – Manómetros, Bombas de vacío, Recuperadores, Herramientas de mano.
4. **Electrodomésticos** – Línea blanca, Línea comercial.
5. **Contacto**.

## 1. Requisitos

- Hosting con WordPress 6.0 o superior y PHP 7.4 o superior (recomendado PHP 8.1+).
- Plugin **WooCommerce** (gratis).

## 2. Instalar el theme

1. Descargá `clima-pro-theme.zip`.
2. En el panel de WordPress andá a **Apariencia > Temas > Añadir nuevo > Subir tema**, elegí el zip y tocá **Instalar ahora**.
3. Tocá **Activar**.

(Alternativa por FTP: subí la carpeta `theme/clima-pro` a `wp-content/themes/`.)

## 3. Instalar WooCommerce en modo catálogo

1. **Plugins > Añadir nuevo**, buscá **WooCommerce**, instalalo y activalo. Podés saltear el asistente de configuración.
2. En **Ajustes > Generales** elegí **Idioma del sitio: Español de Argentina** (WordPress descarga la traducción de WooCommerce sola).
3. En **WooCommerce > Ajustes > General** configurá moneda **Peso argentino ($)**, separador de miles `.`, decimal `,` y 0 decimales (la configuración en un clic ya lo deja así).
4. No hace falta configurar pagos ni envíos: el theme desactiva la compra. Lo que hace:
   - Ningún producto es "comprable": no aparece el botón **Añadir al carrito** en ningún lado.
   - En listados y fichas aparece **Consultar por WhatsApp**.
   - Las páginas de carrito y finalizar compra redirigen a la tienda y se ocultan del menú.
   - No se cargan los scripts del carrito (el sitio es más rápido).
5. En **Ajustes > Enlaces permanentes** elegí **Nombre de la entrada** y guardá.

## 4. Configuración en un clic

Andá a **Apariencia > Clima Pro** y tocá **Ejecutar configuración**. Crea (sin duplicar nada si lo repetís):

- Las categorías y subcategorías de Insumos, Herramientas y Electrodomésticos.
- Las páginas **Inicio**, **Servicios** y **Contacto** con sus plantillas.
- La portada estática (Inicio).
- El menú principal con las 5 secciones (también se usa en el pie).
- Ajustes de WooCommerce para catálogo.
- Fotos de cada categoría (se importan una sola vez a la Biblioteca de medios).
- Opcional: marcá **Crear también 11 productos de muestra (con fotos)**.

Al activar el theme esto ya se ejecuta una vez (sin productos de muestra). Si WooCommerce todavía no estaba activo, volvé a ejecutarlo después de activarlo.

## 5. Configurar el número de WhatsApp y los datos de contacto

**Apariencia > Personalizar > Clima Pro**:

- **WhatsApp**: número en formato internacional, solo números. Para Argentina: `549` + código de área sin 0 + número sin 15. Ej.: `5491123456789`. También podés elegir los **productos por página** (24 por defecto).
- **Datos de contacto**: teléfono, email, dirección, horarios y mapa (Google Maps > Compartir > Insertar un mapa > copiá solo la URL del `src`).
- **Redes sociales**: Facebook, Instagram, YouTube.

El logo se puede reemplazar en **Personalizar > Identidad del sitio > Logo**.

### Shortcode de WhatsApp

```
[clima_whatsapp_button]                                  // en una ficha: usa el producto actual
[clima_whatsapp_button product_id="123"]                 // producto específico
[clima_whatsapp_button message="Hola, quiero un presupuesto" label="Pedir presupuesto"]
```

## 6. Categorías

Se editan en **Productos > Categorías**. Para agregar una subcategoría, creá una categoría nueva y elegí su **Categoría superior** (por ejemplo, *Insumos*). Las subcategorías aparecen solas como accesos rápidos arriba del listado y en el árbol de filtros.

## 7. Miles de productos: cómo está preparado

- Navegación por subcategorías (chips arriba del listado + árbol en la barra lateral).
- Filtro por precio (desde/hasta) y orden (popularidad, precio, más nuevos) sin AJAX: cada filtro es un link que se puede compartir y que Google indexa.
- Paginación clásica (rápida, sin scroll infinito) y productos por página configurables.
- Buscador del encabezado limitado a productos.
- Imágenes con carga diferida (`loading="lazy"`) y decodificación asíncrona.
- Si querés filtros más avanzados (por marca, gas, potencia), agregá widgets o bloques de WooCommerce en **Apariencia > Widgets > Filtros de la tienda** (por ejemplo *Filtrar por atributo*). Si dejás esa zona vacía, se usan los filtros propios del theme.
- Recomendado para catálogos grandes: un plugin de caché (por ejemplo LiteSpeed Cache o WP Super Cache) y subir imágenes en WebP.

## 8. Importar productos en bloque (CSV)

1. **Productos > Todos los productos > Importar** (o el botón en **Apariencia > Clima Pro**).
2. Elegí `sample-data/productos-muestra.csv` (o tu propio archivo; las fotos de muestra se descargan desde este repositorio de GitHub) y tocá **Continuar**.
3. Revisá el mapeo de columnas y tocá **Ejecutar el importador**.

Formato de las columnas principales:

| Columna | Ejemplo |
|---|---|
| Type | `simple` |
| SKU | `CP-INS-001` (si repetís el SKU y marcás "Actualizar productos existentes", se actualiza) |
| Name | `Compresor 1/4 HP R134a` |
| Regular price | `142500` (sin puntos ni signo $) |
| Categories | `Insumos > Compresores` (usá `>` para la jerarquía, `,` para varias) |
| Images | URLs de las imágenes separadas por coma |
| Is featured? | `1` para que aparezca en **Productos destacados** del inicio |

Para miles de productos, dividí el CSV en archivos de 1.000–2.000 filas. Los productos sin imagen muestran una ilustración de Clima Pro según su categoría.

## 9. Administrar productos desde Android (app oficial de WooCommerce, gratis)

1. Instalá **WooCommerce** desde Google Play (de Automattic).
2. Tu sitio tiene que estar online con HTTPS.
3. Opción A (recomendada): instalá el plugin **Jetpack** en tu WordPress, conectalo con una cuenta gratuita de WordPress.com, y en la app elegí **Iniciar sesión con WordPress.com**.
4. Opción B: en la app elegí **Ingresar la dirección de tu tienda** y entrá con tu usuario de WordPress. La app usa **contraseñas de aplicación** (Usuarios > Perfil > Contraseñas de aplicación); si tu hosting o un plugin de seguridad las bloquea, habilitalas o usá la opción A.
5. Desde **Productos** podés crear, editar (nombre, precio, fotos con la cámara, categorías, stock) y eliminar productos. Los cambios se ven al instante en el sitio, con el botón de WhatsApp ya armado.

Las secciones de pedidos y pagos de la app no se usan porque el sitio es solo catálogo.

## 10. Animaciones y accesibilidad

- Aparición suave al hacer scroll (IntersectionObserver), efectos al pasar el mouse, movimiento sutil del hero y pulso del botón flotante de WhatsApp.
- Si el dispositivo tiene activado **reducir movimiento**, las animaciones se desactivan.
- Contraste alto, enlace "Saltar al contenido", foco visible y menú móvil accesible.

## Probado

- `php -l` sin errores en todos los archivos PHP.
- WordPress 6.x + WooCommerce (última versión) con SQLite en local: activación del theme, configuración en un clic, carrito/checkout redirigiendo a la tienda, links de WhatsApp con el mensaje codificado, filtros de precio y vistas de escritorio y móvil.

## Imágenes y logo

- Todas las fotos (hero, banners, productos, categorías y servicios) son **imágenes originales generadas con IA para Clima Pro**: no tienen derechos de terceros, no muestran personas reales identificables ni logos de otras marcas. Están optimizadas en WebP (10–50 KB cada una).
- Para reemplazarlas con fotos propias: cargá la foto destacada del producto o la miniatura de la categoría desde el panel (o desde la app de Android). Si un producto no tiene foto, se muestra automáticamente la foto de su categoría.
- El logo es vectorial (texto convertido a curvas, tipografía Poppins ExtraBold, licencia OFL): copo de nieve blanco, "Clima" en blanco/azul y "Pro" en naranja `#ff7a1a`, con la bajada "Climatización, servicio técnico e insumos". Hay versión para fondo oscuro y para fondo claro, en SVG y PNG.

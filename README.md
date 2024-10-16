# Sistema de Gestión de Desperdicios de Alimentos

## Concepto Básico

El proyecto de Gestión de Desperdicios de Alimentos tiene como objetivo:
- Recoger comida sobrante de donantes (hoteles, restaurantes, salones de bodas, etc.)
- Distribuir esta comida a personas necesitadas

## Tecnologías Utilizadas

| Componente | Tecnología |
|------------|------------|
| Interfaz   | HTML, CSS, JavaScript |
| Servidor   | PHP |
| Servidor Web | XAMPP |
| Base de Datos | MySQL |

## Características Destacadas

- 📱 Diseño adaptable a dispositivos móviles
- 🤖 Soporte de chatbot
- 🔒 Inicio de sesión seguro

## Estructura del Sistema

El sistema se compone de tres módulos principales:

1. **Módulo de Usuario**
2. **Módulo de Administrador**
3. **Módulo de Repartidor**

### Módulo de Usuario

Diseñado para donantes de comida sobrante.

**Funcionalidades:**
- Registro e inicio de sesión de usuarios
- Donación de comida (selección de tipo y cantidad)
- Visualización de donaciones realizadas
- Emparejamiento automático con beneficiarios cercanos

### Módulo de Administrador

Para fundaciones, ONGs y organizaciones benéficas.

**Funcionalidades:**
- Gestión de donaciones recibidas
- Listado de donaciones disponibles
- Seguimiento de solicitudes y asignaciones

### Módulo de Repartidor

Para voluntarios de recogida y entrega.

**Funcionalidades:**
- Registro de repartidores
- Visualización de ubicaciones de recogida y entrega
- Gestión de servicios de recogida y entrega

## Cómo Ejecutar el Proyecto
1. **Descarga el proyecto:**
   - Baja el archivo ZIP del proyecto.

2. **Prepara los archivos:**
   - Extrae el contenido del ZIP.
   - Copia la carpeta extraída.

3. **Ubica los archivos:**
   - Pega la carpeta en el directorio raíz de tu servidor web:
     * Para XAMPP: `xampp/htdocs`
     * Para WAMP: `wamp/www`
     * Para LAMP: `/var/www/html`

4. **Configura la base de datos MySQL:**
   - Abre PHPMyAdmin en tu navegador: `http://localhost/phpmyadmin`
   - Crea una nueva base de datos.
   - Importa el archivo `demo.sql` que está en la carpeta "database" del proyecto.

5. **Inicia la aplicación:**
   - Abre tu navegador y ve a: `http://localhost/nombre_de_la_carpeta`
   - Reemplaza "nombre_de_la_carpeta" con el nombre que le diste a la carpeta del proyecto.

📌 **Nota:** Asegúrate de que el servidor web (XAMPP, WAMP o LAMP) esté en funcionamiento antes de intentar acceder a la aplicación.

## Beneficios del Sistema

1. Reducción eficiente del desperdicio de alimentos
2. Ayuda directa a personas necesitadas
3. Facilitación de la participación comunitaria en donaciones
4. Optimización del proceso de distribución de alimentos

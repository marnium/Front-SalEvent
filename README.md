# APLICACIÓN WEB SALEVENT V1.0
_Esta aplicación fue realizada con el proposito de realizar reservaciones de un salón de eventos. Esta permite crear, buscar, modificar/actualizar y eliminar (CRUD) las reservaciones._

### TIPOS DE USUARIOS
_La aplicación cuenta con dos tipos de usuarios_
- **Usuario cliente**: Este tipo de usuario es considerado como el cliente el cual puede realizar cotizaciones, reservas y consultas del salon de eventos.
- **Usuario Administrador**: Este tipo de usuario es el encargado de administrar los eventos/acciones que suceden en la aplicacion web modificar/eliminar.


## Comenzando 🚀
_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

### Pre-requisitos 📋
* Sistema Gestor de Base de Datos MySQL
* Servidor Web Apache
* Interprete de PHP
* Modulos libapache2-mod-php y php-mysql

Instalación en GNU/Linux:
```
sudo apt install mysql-server php apache2 libapache2-mod-php php-mysql
```

_**NOTA**: XAAMP realiza de forma automatica la instalación de estos programas_

### Instalación 🔧
* Clonar el repositorio y apuntar la ruta del servidor web al directorio generado por la clonación del repositorio (todo esto con el fin de no tener problemas con las rutas)
* Ejecutar el script **database/database.sql**

En el CLI de MySQL:
```
source database/database.sql
```

## Visualización de la app en un navegador
### Público en general
_Tienen a su diposición las opciones de:_
#### Inicio
![init](https://user-images.githubusercontent.com/53574794/97509071-db256c00-1946-11eb-86bf-edffe70d14c2.png)
#### Servicio
![servicesHome](https://user-images.githubusercontent.com/53574794/97509247-5e46c200-1947-11eb-9a67-e8fd06bb84f3.png)
#### Contacto
![contact](https://user-images.githubusercontent.com/53574794/97507050-fa6dca80-1941-11eb-85ea-6e49a394562a.png)
#### Registrarse
![register](https://user-images.githubusercontent.com/53574794/97475838-5a00b180-1913-11eb-94b7-5ee951aaacd3.png)
#### Acceder
![login](https://user-images.githubusercontent.com/53574794/97506675-1e7cdc00-1941-11eb-8b2e-731683d84429.png)

### Administrador
_La app cuenta con un solo administrador, este biene configurado por defecto, los datos para su acceso son:_
 - **Usuario**: `admin`
 - **Contraseña**: `admin`

_El administrador cuenta con las opciones de:_
#### Clientes
_Le permiten al administrador crear, buscar, modificar y eliminar clientes de la base de datos_

![clientsAdm](https://user-images.githubusercontent.com/53574794/97509291-83d3cb80-1947-11eb-8d01-af6273e654fb.png)

#### Reservaciones
_Permite ver y confirmar reservaciones_

![reservationsAdm](https://user-images.githubusercontent.com/53574794/97509345-a6fe7b00-1947-11eb-9365-3a69e5de60eb.png)

#### Servicios
_Permite crear, buscar, modificar servicios_

![servicesAdm](https://user-images.githubusercontent.com/53574794/97509373-ba114b00-1947-11eb-8b89-e930a9dd5ee3.png)

#### Salón
_Permite modificar los datos del saón de eventos_

![salonAdm](https://user-images.githubusercontent.com/53574794/97509418-d614ec80-1947-11eb-8b81-22dcb2d54ded.png)

#### Datos personales
_Le permite al administrador ver y modificar sus datos personales_

![infoAdm](https://user-images.githubusercontent.com/53574794/97509445-ecbb4380-1947-11eb-8d08-19fbdb5400de.png)

### Cliente
#### Calendario
_Le permite al usuario ver y seleccionar un fecha a reservar sus reservaciones_

![calUser](https://user-images.githubusercontent.com/53574794/97509487-0a88a880-1948-11eb-85c8-303723310df0.png)

#### Mis reservaciones
_Le muestra al usuario sus reservaciones_

![reservationsUser](https://user-images.githubusercontent.com/53574794/97509523-255b1d00-1948-11eb-824c-70dbb394e5bf.png)

#### Ajustes
_Muestran los datos personales del usuario_

![settings](https://user-images.githubusercontent.com/53574794/97509575-415ebe80-1948-11eb-9128-df7afb55382f.png)

## Autores
* **Eleomar Pedro Lorenzo**
* **José Luis Cruz Arguelles**
* **Heraclio Galván Torres**
* **Héctor Hugo González Rodríguez**
* **Martín Monjaraz Almaraz**
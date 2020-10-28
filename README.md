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
* Mover o clonar el proyecto a la ruta donde apunte su servidor
* Ejecutar el script **database/database.sql**

En el CLI de MySQL:
```
source database/database.sql
```

## Visualización de la app en un navegador
### Público en general
_Tienen a su diposición las opciones de:_
#### Inicio
![Home](https://user-images.githubusercontent.com/53574794/97446729-64f81980-18f4-11eb-819b-98a7df389313.PNG)
#### Servicio
![ServiciosHome](https://user-images.githubusercontent.com/53574794/97455568-9cb78f00-18fd-11eb-873b-267605285f53.PNG)
#### Contacto
![Contactus](https://user-images.githubusercontent.com/53574794/97446711-5f9acf00-18f4-11eb-98cf-db54758f1193.PNG)
#### Registrarse
![register](https://user-images.githubusercontent.com/53574794/97475838-5a00b180-1913-11eb-94b7-5ee951aaacd3.png)
#### Acceder
![Loggin](https://user-images.githubusercontent.com/53574794/97446749-6b869100-18f4-11eb-8f68-8dac6b451d61.PNG)

### Administrador
_La app cuenta con un solo administrador, este biene configurado por defecto, los datos para su acceso son:_
 - **Usuario**: `admin`
 - **Contraseña**: `admin`

_El administrador cuenta con las opciones de:_
#### Clientes
_Le permiten al administrador crear, buscar, modificar y eliminar clientes de la base de datos_

![Clientes](https://user-images.githubusercontent.com/53574794/97446699-5ad61b00-18f4-11eb-9ae4-aa5de24e1641.PNG)

#### Reservaciones
_Permite ver y confirmar reservaciones_

![Reservaciones](https://user-images.githubusercontent.com/53574794/97446765-6fb2ae80-18f4-11eb-9291-35e4ff6ee4c6.PNG)

#### Servicios
_Permite crear, buscar, modificar servicios_

![Servicios](https://user-images.githubusercontent.com/53574794/97446797-75a88f80-18f4-11eb-9619-8f50b3ec760b.PNG)


#### Salón
_Permite modificar los datos del saón de eventos_

![Salon](https://user-images.githubusercontent.com/53574794/97446778-72ad9f00-18f4-11eb-91a1-4d9833975c6d.PNG)


#### Datos personales
_Le permite al administrador ver y modificar sus datos personales_

![Datos](https://user-images.githubusercontent.com/53574794/97446722-6295bf80-18f4-11eb-8b2d-f5437912b6fb.PNG)

### Cliente
#### Calendario
_Le permite al usuario ver y seleccionar un fecha a reservar sus reservaciones_

![calendarCli](https://user-images.githubusercontent.com/53574794/97474771-135e8780-1912-11eb-9873-df7a0730bcc5.PNG)

#### Mis reservaciones
_Le muestra al usuario sus reservaciones_

![reservationsCli](https://user-images.githubusercontent.com/53574794/97475294-b0212500-1912-11eb-9d35-6c18b798e5b4.PNG)

#### Ajustes
_Muestran los datos personales del usuario_

![settingsCli](https://user-images.githubusercontent.com/53574794/97475421-db0b7900-1912-11eb-88f8-c5934c84253c.PNG)

## Autores
* **Eleomar Pedro Lorenzo**
* **José Luis Cruz Arguelles**
* **Heraclio Galván Torres**
* **Héctor Hugo González Rodríguez**
* **Martín Monjaraz Almaraz**
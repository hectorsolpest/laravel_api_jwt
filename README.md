# 🔐 API Laravel con Autenticación JWT

Este repositorio documenta mi proceso de aprendizaje e implementación de **autenticación JWT** en una API RESTful construida con Laravel. El proyecto sirve como ejemplo práctico y guía para desarrolladores que quieran implementar autenticación segura en sus aplicaciones.

## 🚀 Características Principales

- **Sistema de autenticación JWT** completo y seguro
- **Registro y login de usuarios** con validación
- **Protección de rutas** con middleware de autenticación
- **Renovación de tokens** mediante refresh tokens
- **Logout** con invalidación de tokens
- **Gestión de perfiles** de usuario
- **Ejemplos prácticos** de implementación

## 📚 Lo que Aprendí

### 1. Configuración de JWT en Laravel
```bash
# Instalación del paquete tymon/jwt-auth
composer require tymon/jwt-auth
```

### 2. Implementación de Middleware de Autenticación
```php
// Rutas protegidas
Route::middleware('auth:api')->group(function () {
    Route::get('/user', [AuthController::class, 'userProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
```

### 3. Manejo de Tokens y Refresh Tokens
```php
// Generación de token
$token = auth()->attempt($credentials);
$refreshToken = auth()->refresh();

// Respuesta con tokens
return response()->json([
    'access_token' => $token,
    'refresh_token' => $refreshToken,
    'token_type' => 'bearer',
    'expires_in' => auth()->factory()->getTTL() * 60
]);
```

### 4. Gestión de Errores y Excepciones
```php
try {
    // Intento de autenticación
    if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
} catch (JWTException $e) {
    return response()->json(['error' => 'Could not create token'], 500);
}
```

## 🛠️ Tecnologías Utilizadas

- **Laravel 9/10** - Framework PHP
- **tymon/jwt-auth** - Paquete para autenticación JWT
- **PHP 8.0+** - Lenguaje de programación
- **MySQL** - Base de datos
- **Postman** - Testing de endpoints

## 📦 Instalación y Configuración

1. **Clonar el repositorio**
```bash
git clone https://github.com/tu-usuario/laravel-jwt-api.git
cd laravel-jwt-api
```

2. **Instalar dependencias**
```bash
composer install
```

3. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar JWT Secret**
```bash
php artisan jwt:secret
```

5. **Configurar base de datos**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_jwt
DB_USERNAME=root
DB_PASSWORD=
```

6. **Ejecutar migraciones**
```bash
php artisan migrate
```

7. **Iniciar servidor**
```bash
php artisan serve
```

## 📡 Endpoints de la API

### Autenticación
- `POST /api/register` - Registrar nuevo usuario
- `POST /api/login` - Iniciar sesión
- `POST /api/logout` - Cerrar sesión
- `POST /api/refresh` - Refrescar token
- `GET /api/me` - Obtener perfil de usuario

### Ejemplo de uso:
```bash
# Registro
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com","password":"password"}'

# Login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password"}'
```

## 🧪 Testing con Postman

1. Importa la colección de Postman incluida en el repositorio
2. Configura las variables de entorno en Postman:
   - `base_url`: http://localhost:8000/api
   - `token`: (se actualizará automáticamente al hacer login)

## 🔒 Consideraciones de Seguridad

- Tokens JWT con expiración configurable
- Refresh tokens para renovación segura
- Validación de datos de entrada
- Protección contra ataques CSRF
- Contraseñas hasheadas con bcrypt

## 📖 Recursos de Aprendizaje

- [Documentación oficial de JWT](https://jwt.io/)
- [Documentación de tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)
- [Laravel Authentication Documentation](https://laravel.com/docs/authentication)

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Siéntete libre de:
- Reportar bugs o problemas
- Sugerir nuevas características
- Enviar pull requests
- Mejorar la documentación

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 💡 Consejos para Implementación

1. **Always validate incoming data** - Nunca confíes en los datos del usuario
2. **Use HTTPS in production** - Para proteger los tokens en tránsito
3. **Implement rate limiting** - Para prevenir abuso de los endpoints
4. **Store tokens securely** - En el cliente, usa httpOnly cookies o secure storage

## 🌟 Próximos Pasos

- [ ] Implementar verificación de email
- [ ] Añadir sistema de roles y permisos
- [ ] Implementar two-factor authentication
- [ ] Crear frontend de ejemplo con Vue.js/React

---

¿Te sirvió este proyecto? ¡Dale una ⭐ al repositorio y compártelo con otros desarrolladores!

**¡Happy coding!** 🚀

<?php
// Parámetros de conexión
$host = 'localhost';
$db = 'sakila';
$user = 'root';
$pass = 'root';

// Función para crear la conexión a la base de datos
function conectarBaseDatos()
{
    global $host, $db, $user, $pass;
    try {
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "<h1>Error de conexión:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

// Función para los registros totales en cualquier tabla
function totalTabla($pdo, $tabla)
{
    try {
        $stmt = $pdo->query("Select count(*) as total from $tabla");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

// Función para películas alquiladas
function peliculasAlquiladas($pdo)
{
    try {
        $stmt = $pdo->query("Select count(*) as total from rental where return_date is NULL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

// Función para ver todas las películas
function devolverPeliculas($pdo)
{
    try {
        $stmt = $pdo->query("Select film_id, title, description, release_year, length, rental_rate  from film");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function consultaCategoria($pdo, $filmID){
    try{
        $stmt = $pdo->prepare("select categoria from 
        (select a.name as categoria, b.film_id as id_pelicula from category as a join film_category as b on a.category_id = b.category_id) as tabla 
        where id_pelicula = :filmID");
        $stmt->execute([':filmID' => $filmID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function nombrePelicula($pdo, $filmID){
    try{
        $stmt = $pdo->prepare("select b.title from inventory as a join film as b on a.film_id = b.film_id where a.inventory_id = :filmID limit 1;");
        $stmt->execute([':filmID' => $filmID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function nombreCliente($pdo, $clienteID){
    try{
        $stmt = $pdo->prepare("select first_name, last_name from customer where customer_id= :cliente;");
        $stmt->execute([':cliente' => $clienteID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}


// Función para ver datos una pelicula
function peliculaSeleccionada($pdo, $id)
{
    try {
        $stmt = $pdo->prepare("Select film_id, title, description, release_year, length, language_id, original_language_id, rental_duration,
        rental_rate, length, replacement_cost, rating, special_features, last_update  from film where film_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

// Función para ver datos de un cliente
function clienteSeleccionado($pdo, $id)
{
    try {
        $stmt = $pdo->prepare("Select customer_id, store_id, first_name, last_name, email, address_id, active from customer
         where customer_id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}



//Función para ver todos los clientes
function clientes($pdo)
{
    try {
        $stmt = $pdo->query("Select customer_id, first_name, last_name, email, address_id, active  from customer");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function alquileres($pdo)
{
    try {
        $stmt = $pdo->query("Select inventory_id as pelicula, customer_id as cliente, rental_date as fecha_alquiler, return_date as fecha_devolucion, staff_id as empleado from rental");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function agregarPelicula(
    $pdo,
    $title,
    $description,
    $release_year,
    $language_id,    
    $rental_duration,
    $rental_rate,
    $length   
) {

    try {
        $release_year = (int) $release_year;
        $language_id = (int) $language_id;
        $stmt = $pdo->prepare("INSERT INTO film (title, description, release_year, language_id, 
                     rental_duration, rental_rate, length)
                      VALUES (:title, :description, :release_year, :language_id, 
                    :rental_duration, :rental_rate, :length)");
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'release_year' => $release_year,
            'language_id' => $language_id,            
            'rental_duration' => $rental_duration,
            'rental_rate' => $rental_rate,
            'length' => $length            
        ]);
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function agregarCliente($pdo, $first_name, $last_name, $email, $address, $active) {
    try {
        $stmt = $pdo->prepare("INSERT INTO customer (first_name, last_name, email, address_id, active, store_id)
         VALUES (:first_name, :last_name, :email, :address, :active, 1)");
         $stmt->execute([
            'first_name' => $first_name, 
            'last_name' => $last_name,
            'email' => $email,
            'address' => $address,
            'active' => $active
         ]);
         return $stmt->rowcount();     
    } catch (PDOException $e){
        echo "<h1>Error en la consulta:</h1>" . $e->getMessage() . "</p>";
        exit;
    }
}

function actualizarPelicula(
    $pdo,
    $filmID,
    $titulo,
    $descripcion,
    $publicacion,
    $idioma,   
    $tiempoAlquilado,
    $rangoPublicacion,
    $duracion) {
    try {        
        $stmt = $pdo->prepare("UPDATE film SET title = :titulo, description = :descripcion, 
        release_year = :publicacion, language_id = :idioma, 
        rental_duration = :tiempoAlquilado, 
        rental_rate = :rangoPublicacion, length = :duracion
        WHERE film_id = :filmID");
        $stmt->execute([
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'publicacion' => $publicacion,
            'idioma' => $idioma,            
            'tiempoAlquilado' => $tiempoAlquilado,
            'rangoPublicacion' => $rangoPublicacion,
            'duracion' => $duracion,
            'filmID' => $filmID,            
        ]);
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function actualizarCliente(
    $pdo,
    $customer_id,
    $store_id ,
    $first_name ,
    $last_name ,
    $email ,  
    $address_id,
    $active   
    
    ) {
    try {        
        $stmt = $pdo->prepare("UPDATE customer SET store_id = :store_id, first_name = :first_name, 
        last_name = :last_name, email = :email, 
        address_id = :address_id, active = :active
        WHERE customer_id = :customer_id");
        $stmt->execute([
            'store_id' => $store_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,            
            'address_id' => $address_id,            
            'customer_id' => $customer_id, 
            'active' => $active,              
        ]);
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function borrarPelicula($pdo, $peliculaID)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM film WHERE film_id = :peliculaID");
        $stmt->execute([':peliculaID' => $peliculaID]);
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

function borrarCliente($pdo, $clienteID)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM customer WHERE customer_id = :clienteID");
        $stmt->execute([':clienteID' => $clienteID]);
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

/*function filtrarPelicula($pdo, $cadena){
    try{
        $filtro = "'%" . $cadena . "%'";        
        $stmt = $pdo->prepare("Select  * from film WHERE title like :filtro");
        $stmt->execute([':filtro' => $filtro]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";  
    }
}
*/
function filtrarPelicula($pdo, $cadena) {
    try {
        $filtro = "%" . $cadena . "%";
        $stmt = $pdo->prepare("SELECT * FROM film WHERE title LIKE :filtro");
        $stmt->bindParam(':filtro', $filtro, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Usa fetchAll para obtener todos los resultados
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        return false;
    }
}




/* Función para obtener la lista de países
function obtenerPaises($pdo) {
    try {
        $stmt = $pdo->query("SELECT Code, Name FROM country ORDER BY Name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h1>Error en la consulta:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
} */

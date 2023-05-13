<?php

    namespace App;

    class Usuario extends ActiveRecord{
        //Base de datos
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id', 'nombre', 'apellido', 'correo', 'telefono', 'password', 'idRol', 
        'token', 'confirmado', 'creado'];

        public $id;
        public $nombre;
        public $apellido;
        public $correo;
        public $telefono;
        public $password;
        public $idRol;
        public $token;
        public $confirmado;
        public $creado;

        public function __construct($args=[])
        {
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->apellido = $args['apellido'] ?? '';
            $this->correo = $args['correo'] ?? '';
            $this->telefono = $args['telefono'] ?? '';
            $this->password = $args['password'] ?? '';
            $this->idRol = $args['idRol'] ?? '2';
            $this->token = $args['token'] ?? '';
            $this->confirmado = $args['confirmado'] ?? '0';
            $this->creado = date('Y-m-d');
        }

        /* Mensajes de validacion */
        public function validarNuevaCuenta(){

            if(!$this->nombre){
                self::$errores[] = 'El nombre es Obligatorio';
            }

            if(!$this->apellido){
                self::$errores[] = 'El apellido es Obligatorio';
            }

            if(!$this->correo){
                self::$errores[] = 'El correo es Obligatorio';
            }

            if(!$this->telefono){
                self::$errores[] = 'El telefono es Obligatorio';
            }

            if(!$this->password){
                self::$errores[] = 'El password es Obligatorio';
            }

            if(strlen($this->password) < 6){
                self::$errores[] = 'El password debe contener al menos 6 caracteres';
            }

            return self::$errores;
        }

        public function validarLogin(){

            if(!$this->correo){
                self::$errores[] = 'El email es obligatorio';
            }

            if(!$this->password){
                self::$errores[] = 'El password es obligatorio';
            }

            return self::$errores;
        }

        public function validarEmail(){
            if(!$this->correo){
                self::$errores[] = 'El email es obligatorio';
            }

            return self::$errores;
        }

        public function validarPasword(){
            if(!$this->password){
                self::$errores[] = 'El Pasword es obligatorio';
            }

            if(strlen($this->password) < 6){
                self::$errores[] = 'El password debe contener al menos 6 caracteres';
            }

            return self::$errores;
        }

        //Revisa si el usuario ya existe
        public function existeUsuario(){
            $query = "SELECT * FROM " . self::$tabla . " WHERE correo = '" . $this->correo ."' LIMIT 1";

            $resultado = self::$db->query($query);

            if($resultado->num_rows){
                self::$errores[] = 'El Usuario ya esta registrado';
            }

            return $resultado;
        }

        public function hashPassword(){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }

        public function crearToken(){
            $this->token = uniqid();
        }

        public function comprobarPasswordAndVerificado($password){
            $resultado = password_verify($password, $this->password);

            if(!$resultado || !$this->confirmado){
                self::$errores[] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
            }else{
                return true;
            }
        }
    }
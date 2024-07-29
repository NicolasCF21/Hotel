<?php
class Product {
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "hotel2";   
	private $productTable = 'habitacion';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error al conectar con MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error en la consulta: '. mysqli_error($conn));
		}
		$data= array();
		
		/*while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {*/
			while ($row = mysqli_fetch_assoc($result)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error en la consulta: '. mysqli_error($conn));
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}		
	public function getBrand(){
		$sqlQuery = "
			SELECT id_tipo_habitacion, tipo_habitacion
			FROM tipo_habitacion 
			ORDER BY id_tipo_habitacion ASC";
        return  $this->getData($sqlQuery);
	}
	
	public function searchProducts(){
		$sqlQuery = "SELECT * FROM habitacion h JOIN tipo_habitacion t ON h.id_tipo_habitacion = t.id_tipo_habitacion";
		if(isset($_POST["minPrice"], $_POST["maxPrice"]) && !empty($_POST["minPrice"]) && !empty($_POST["maxPrice"])){
			$sqlQuery .= "
			AND h.precio_Tb BETWEEN '".$_POST["minPrice"]."' AND '".$_POST["maxPrice"]."'";
		}
		if(isset($_POST["brand"])) {
			$brandFilterData = implode("','", $_POST["brand"]);
			$sqlQuery .= "
			AND t.id_tipo_habitacion IN('".$brandFilterData."')";
		}
			
		$sqlQuery .= " ORDER By h.id_habitacion";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$totalResult = mysqli_num_rows($result);
		$searchResultHTML = '';
		if($totalResult > 0) {
			/*while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {*/
			while ($row = mysqli_fetch_assoc($result)) {
				$searchResultHTML .= "
				<div class='col-lg-12 col-sm-12'>
                	<div class='card bg-secondary bg-opacity-25 my-3 border-0 shadow-sm' style='max-width: 900px;'>
                        <div class='row g-2'>
                        	<div class='col-md-7 order-sm-last '>
                                <div class='card-body text-start'>
                                    <h2 class='text-center card-title fs-3'><a style='text-decoration:none;' class='text-dark' href='http://localhost/hotel/habitaciones/habitacion.php?id=".$row["id_habitacion"]."'>".$row["nombre_habitacion"]."</a></h2>
                                    <div class='d-flex'>
                                        <small class='fw-bold'>Tipo: ".$row["tipo_habitacion"]."</small>
                                    </div>
                                    <div class='mb-0'> 
                                        <p>".$row["descripcion_habitacion"]."</p>
                                    </div>
                                    <div class='text-center'>
                                        <i class='bi-tv' style='font-size:25px'></i>
                                        <i class='bi-wifi ms-2' style='font-size:25px'></i>
                                        <i class='bi-water ms-2' style='font-size:25px;'></i>
                                    </div>
                                    <div class='mt-0 text-start d-flex justify-content-between'>
                                        <h5 class=' mb-0 me-1'>$".$row["precio_Tb"]."<small class='fw-light'>/por noche</small></h5>
                                        <a class='btn btn-sm btn-dark' href='http://localhost/hotel/habitaciones/habitacion.php?id=".$row["id_habitacion"]."'>Reservar</a>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-5'>
                            	<div class='hover-in order-lg-first p-2'>
                                    <a href='../habitaciones/habitacion.php?id=".$row["id_habitacion"]."'>
                                    	<img src='".$row["imagen_habitacion"]."' class='img-fluid rounded-2 my-3'>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
			}
		} else {
			$searchResultHTML = '<h3 class="mt-4">No se ha encontrado ninguna habitación..</h3>';
		}
		return $searchResultHTML;	
	}	
}
?>
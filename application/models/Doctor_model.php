<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function insert_doctor($data){
		$sql = "insert into doctor (telefono_movil, cve_esp, cve_usu, cve_vigencia) values('".$data['telmov']."',".$data['espk'].",".$data['usuk'].", (select cve from vigencia where descripcion = 'vigente') ) RETURNING cve";
		$res = $this->db->query($sql);
		return $res->result_array();
	}


	public function delete_doctor($data){
		//si tiene citas todavia el doctor
		$sql = "select * from cita where (cve_usu =".$data['cve']." and fecha > now())";
		$res = $this->db->query($sql);
		if ($res->num_rows() == 0){
			$sql = "update doctor  SET cve_vigencia = 2 WHERE cve_usu = ".$data['cve']."";
			$res = $this->db->query($sql);
		}
		
	}	

	public function update_doctor($data){
		$sql = "UPDATE usuario set nombre='".$data['nom']."', ap_paterno='".$data['appat']."', ap_materno='".$data['apmat']."' ,telefono_particular='".$data['telpar']."' where cve= (SELECT cve_usu FROM doctor WHERE cve=".$data['cve_usu'].")";		
		$this->db->query($sql);
		$sql = "UPDATE doctor set telefono_movil='".$data['telmov']."', cve_esp='".$data['esp']."', cve_vigencia='".$data['vigencia']."' where cve='".$data['cve_usu']."'";		
		$this->db->query($sql);
	}
		
	/*Obtenermos todos los doctores dados de alta, cve_doctor, nombre y apellido que estan vigentes*/
	public function get_all(){
		$sql = "select doctor.cve AS cdoc, usuario.nombre AS nom, usuario.ap_paterno AS ape from usuario inner join doctor on usuario.cve = doctor.cve_usu where doctor.cve_vigencia = 1";
		$res = $this->db->query($sql);
		return $res->result_array();		
	}
	/*Obtenemos todos los doctores que aun NO tiene asociado un horario , vista dsh = doctores SIN horario*/
	public function get_docs_no_horario(){
		//$sql = "select doctor.cve AS cdoc, usuario.nombre AS nom, usuario.ap_paterno AS ape from usuario inner join doctor on usuario.cve = doctor.cve_usu where doctor.cve_vigencia = 1 and doctor.cve not in (select cve_doc from horario group by cve_doc)";
		$sql = "select * from dsh";
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0){
			return $res->result_array();	
		}
		return FALSE;	
	}
	
	/*Obtenemos todos los doctores que aun SI tiene asociado un horario, vista dch = doctores con horario*/
	public function get_docs_si_horario(){
		//$sql = "select doctor.cve AS cdoc, usuario.nombre AS nom, usuario.ap_paterno AS ape from usuario inner join doctor on usuario.cve = doctor.cve_usu where doctor.cve_vigencia = 1 and doctor.cve in (select cve_doc from horario group by cve_doc)";
		$sql = "select * from dch";
		$res = $this->db->query($sql);
		if ($res->num_rows() > 0){
			return $res->result_array();	
		}
		return FALSE;	
	}
	public function get_doctor($data){
		//$sql = "SELECT doctor.cve AS cve_doc, usuario.nombre AS nombre, usuario.ap_paterno AS apellido FROM doctor INNER JOIN usuario ON doctor.cve_usu = usuario.cve WHERE doctor.cve = ".data['cve_doc'];
		$res = $this->db->query($sql);
		return $res->array_array();		
	}

	
}
?>
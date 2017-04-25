<?php
	
	/**
	* 
	*/
	class Periodoa_Model extends CI_Model
	{
		public function getPeriodoAcademico()
		{
			return $this->db->get('periodo_academico');
		}

		public function insertP($periodo = null)
		{
			if ($periodo != null) {

				$data = array(
					'mesinicio_pera' => $periodo['mesInicio'],
					'anioinicio_pera' => $periodo['anioInicio'],
					'mesfin_pera' => $periodo['mesFin'],
					'aniofin_pera' => $periodo['anioFin']
				);
				return $this->db->insert('periodo_academico', $data);
			}
			return false;
		}

		public function getById($id = '')
		{
			$result = $this->db->query("SELECT * FROM periodo_academico WHERE id_pera = '" . $id . "'");
			return $result->row();
		}

		public function updateP($periodoEdit = null, $id = '')
		{
			if ($periodoEdit != null && $id != '') {

				$data = array(
					'mesinicio_pera' => $periodoEdit['mesInicio'],
					'anioinicio_pera' => $periodoEdit['anioInicio'],
					'mesfin_pera' => $periodoEdit['mesFin'],
					'aniofin_pera' => $periodoEdit['anioFin']
				);
				$this->db->where('id_pera', $id);
				return $this->db->update('periodo_academico', $data);
			}
			return false;
		}

    }
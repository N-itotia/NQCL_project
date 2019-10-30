<?php

class Additional_components_charges extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('test_id','int', 11);
		$this -> hasColumn('dosage_form', 'int', 11);
		$this -> hasColumn('charge', 'int', 11);
        $this -> hasColumn('charge_usd_old','int', 11);
		$this -> hasColumn('charge_kes', 'int', 11);
		$this -> hasColumn('charge_usd', 'int', 11);
	}
	
	public function getAllAdditionalCharges() {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('additional_components_charges');
		$withdrawnData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $withdrawnData;
	}
    
    public function getExtraCharge($test_id, $currency) {
		$query = Doctrine_Query::create()
		-> select('charge_'.$currency)
		-> from('additional_components_charges')
        -> where('test_id =?', $test_id);
		$chargeData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $chargeData;
	}
}
?>
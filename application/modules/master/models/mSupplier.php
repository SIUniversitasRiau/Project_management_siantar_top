<?php

class mSupplier extends MY_Model {

    // constants, column definition
    const ID = 'SUPPLIER_ID';
    const CATEGORY = 'KATEGORI_SUPPLIER_ID';
    const TAX = 'PAJAK_SUPPLIER_ID';
    const CODE = 'SUPPLIER_CODE';
    const NAME = 'SUPPLIER_NAMA';
    const ADDRESS = 'SUPPLIER_ALAMAT';
    const DESCRIPTION = 'SUPPLIER_DESKRIPSI';
    const ACTIVE = 'SUPPLIER_ACTIVE';
    
    const TABLE = "master_supplier";

    function __construct() {
        parent::__construct();
        $this->tableName = mSupplier::TABLE;
        $this->idField = mSupplier::ID;
    }

}

?>
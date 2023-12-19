<?php
$nama = $_GET[''];
$query = $this->db->query("SELECT harga FROM part WHERE nm_part=$nama")->result_array();

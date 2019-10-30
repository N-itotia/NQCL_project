<?php

class Issue extends Doctrine_Record {

    public function setTableDefinition() {
        $this->hasColumn('title', 'varchar', 255);
        $this->hasColumn('issue', 'varchar', 255);
        $this->hasColumn('date_time', 'varchar', 20);       
        $this->hasColumn('status', 'int', 11);
        $this->hasColumn('whose', 'varchar', 255);
        $this->hasColumn('status', 'int', 11);
        $this->hasColumn('time_sorted', 'varchar',20 );
        $this->hasColumn('comment', 'varchar', 255);
        $this->hasColumn('user_id', 'int', 11);
        $this->hasColumn('pm_count', 'int', 11);
        $this->hasColumn('developer', 'varchar', 20);
    }

    public function setUp() {
        $this->setTableName('issue');
    }

   
    public function CountClosedIssues($id) {
        $query = Doctrine_Query::create()
                ->select('count(status) AS solved')
                ->from('issue')
                ->where('status =?', 1)
                ->andWhere('user_id=?', $id)
                ->orderBy('id DESC')
                ->limit(1);
        $countData = $query->execute()->toArray();
        return $countData;
    }

  
}

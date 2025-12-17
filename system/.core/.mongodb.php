<?php

// https://www.php.net/manual/en/class.mongodb-driver-writeresult.php

function mongoConnect(){
	return new \MongoDB\Driver\Manager("mongodb://".DB_MONGO_USER.":".rawurlencode(DB_MONGO_PASS)."@".DB_MONGO_HOST.":".DB_MONGO_PORT);
}

function mongoSelect($collection,$filter=[],$options=[]){
	$manager = mongoConnect();
	$query = new MongoDB\Driver\Query($filter, $options);
	return $manager->executeQuery(DB_MONGO.'.'.$collection, $query)->toArray();
}

function mongoInsert($collection,$value=null){
	$manager = mongoConnect();
	$bulkWrite = new MongoDB\Driver\BulkWrite;
	$bulkWrite->insert($value);
	try {
	    $return = $manager->executeBulkWrite(DB_MONGO.'.'.$collection, $bulkWrite);	
		return $return->getInsertedCount();
	} catch(MongoDB\Driver\Exception\BulkWriteException $e){
	    throw new Exception('Exception message : '.$e->getMessage());
	}	
}

function mongoUpdate1($collection,$filter=[], $update=[], $options=['multi'=>true,'upsert'=>true]){
	$manager = mongoConnect();
	$update = ['$set' => $update];
	$bulkWrite = new MongoDB\Driver\BulkWrite;
	$bulkWrite->update($filter, $update, $options);
	try {
		$return = $manager->executeBulkWrite(DB_MONGO.'.'.$collection, $bulkWrite); 
		return $return->getModifiedCount();
	} catch(MongoDB\Driver\Exception\BulkWriteException $e){
	    throw new Exception('Exception message : '.$e->getMessage());
	}
}

function mongoUpdate($collection, $filter = [], $updateFields = [], $options = ['multi' => true, 'upsert' => true]) {
    if (empty($updateFields)) {
        throw new Exception('No fields provided for update.');
    }
    
    $manager = mongoConnect();
    $update = ['$set' => $updateFields];
    $bulkWrite = new MongoDB\Driver\BulkWrite;
    $bulkWrite->update($filter, $update, $options);
    
    try {
        $result = $manager->executeBulkWrite(DB_MONGO . '.' . $collection, $bulkWrite);
        return $result->getModifiedCount();
    } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
        throw new Exception('MongoDB Bulk Write Exception: ' . $e->getMessage());
    } catch (MongoDB\Driver\Exception\Exception $e) {
        throw new Exception('MongoDB Exception: ' . $e->getMessage());
    }
}

function mongoInsertOrUpdate($collection,$filter=[], $update=[], $options=['multi'=>true,'upsert'=>true]){
	$manager = mongoConnect();
	$update = ['$setOnInsert' => $update, '$set' => $update];
	$bulkWrite = new MongoDB\Driver\BulkWrite;
	$bulkWrite->update($filter, $update, $options);
	try {
	    $return = $manager->executeBulkWrite(DB_MONGO.'.'.$collection, $bulkWrite);	
		if($return->getModifiedCount()){
			return $return->getModifiedCount();
		} elseif($return->getUpsertedCount()){
			return $return->getUpsertedCount();
		}
	} catch(MongoDB\Driver\Exception\BulkWriteException $e){
	    throw new Exception('Exception message : '.$e->getMessage());
	}
}

function mongoDelete001($collection,$filter=[], $options=[]){
	$manager = mongoConnect();
	$bulkWrite = new MongoDB\Driver\BulkWrite;
	$bulkWrite->delete($filter, $options);
	try {
		$result = $manager->executeBulkWrite(DB_MONGO.'.'.$collection, $bulkWrite);	
		return $return->getDeletedCount();
	} catch(MongoDB\Driver\Exception\BulkWriteException $e){
	    throw new Exception('Exception message : '.$e->getMessage());
	}
}

function mongoDelete($collection, $filter = [], $options = []) {
    $manager = mongoConnect();
    $bulkWrite = new MongoDB\Driver\BulkWrite;
    $bulkWrite->delete($filter, $options);
    try {
        $result = $manager->executeBulkWrite(DB_MONGO . '.' . $collection, $bulkWrite);
        return $result->getDeletedCount();
    } catch (MongoDB\Driver\Exception\BulkWriteException $e) {
        throw new Exception('Exception message: ' . $e->getMessage());
    }
}


function mongoAggregate($command=null){
	$manager = mongoConnect();
	// $query = new MongoDB\Driver\Query($filter, $options);
	// return $manager->executeQuery(DB_MONGO.'.'.$collection, $query)->toArray();
	$command = new MongoDB\Driver\Command($command);
	return $manager->executeCommand(DB_MONGO,$command)->toArray();
}

function mongodate($value){
    return new MongoDB\BSON\UTCDateTime(strtotime($value)*1000);
}

function localdate($value,$format='Y-m-d H:i:s'){
    return $value->toDateTime()->setTimeZone(new \DateTimeZone(date_default_timezone_get()))->format($format);
    // return $value->toDateTime()->setTimeZone(new \DateTimeZone(date_default_timezone_get())).format('Y-m-d H:i:s');
}

function autoincreament($collection){
	$options = ['limit' => 1,'sort' => ['_id' => -1], 'projection' => ['_id' => 1] ];
	$id = mongoSelect([],$options,$collection);
	return empty($id) ? 1 : $id[0]->_id+1;
}
<?php


class YSerializeBehavior extends CModelBehavior {

    


    
    public function unserializeAttribute ( $data ,$field)
    {
        if ( isset ( $data[ $field ] ) )
        {
            $data[ $field ] = unserialize ( $data[ $field ] );
            return $data;
        }
        
        if ( isset ($data[0][$field]) )
        {
            $items = array ( );
            foreach ( $data as $row )
            {
                $row[ $field ] = unserialize ( $row[ $field ] );
                $items[ ] = $row;
            }
            return $items;
        }
        return $data;
    }
}
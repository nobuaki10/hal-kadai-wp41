<?php
try{
  throw new Exception("error",999);
}catch( Exception $e){
  echo $e->getMessage();
  echo $e->getCode();
}finally{
  echo "finally";
}

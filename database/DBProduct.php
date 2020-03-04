<?php
    require_once "DB.php";
    class DBProduct
    {
        private $table = "product";

        public function addProduct($category, $subCategory, $productName, $afterDiscount, $beforeDiscount, $image, $quantity)
        {
            $sql="INSERT into $this->table(category,subCategory,productName,afterDiscount,
            beforeDiscount,image,quantity) values (:category,:subCategory,:productName,:afterDiscount
            ,:beforeDiscount,:image,:quantity)";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':category',$category);
            $stmt->bindParam(':subCategory',$subCategory);
            $stmt->bindParam(':productName',$productName);
            $stmt->bindParam(':afterDiscount',$afterDiscount);
            $stmt->bindParam(':beforeDiscount',$beforeDiscount);
            $stmt->bindParam(':image',$image);
            $stmt->bindParam(':quantity',$quantity);
            return $stmt->execute();
        }
        public function getCategories()
        {
            $sql="SELECT distinct category FROM $this->table";
            $stmt=DB::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getSubCategories()
        {
            $sql="SELECT distinct subCategory FROM $this->table";
            $stmt=DB::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getProducts()
        {
            $sql="SELECT * FROM $this->table";
            $stmt=DB::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getProductById($id)
        {
            $sql="SELECT * FROM $this->table where id=:id";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            return $stmt->fetch();
        }
        public function updateProduct($id,$productName, $afterDiscount, $beforeDiscount, $image, $quantity)
        {
            $sql="UPDATE $this->table set productName=:productName,afterDiscount=:afterDiscount,
            beforeDiscount=:beforeDiscount,image=:image,quantity=:quantity where id=:id";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':productName',$productName);
            $stmt->bindParam(':afterDiscount',$afterDiscount);
            $stmt->bindParam(':beforeDiscount',$beforeDiscount);
            $stmt->bindParam(':image',$image);
            $stmt->bindParam(':quantity',$quantity);
            $stmt->bindParam(':id',$id);
            return $stmt->execute();
        }
        public function deleteProduct($id)
        {
            $sql="DELETE from $this->table where id=:id";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':id',$id);
            return $stmt->execute();
        }
        public function getProductsByCatAndSubCat($category,$subCategory)
        {
            $sql="select * from $this->table where category=:category and subCategory=:subCategory";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':category',$category);
            $stmt->bindParam(':subCategory',$subCategory);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getProductByCategory($category)
        {
            $sql="SELECT * FROM $this->table where category=:category";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':category',$category);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function getProductBySubCategory($subCategory)
        {
            $sql="SELECT * FROM $this->table where subCategory=:subCategory";
            $stmt=DB::prepare($sql);
            $stmt->bindParam(':subCategory',$subCategory);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        public function searchProduct($key)
        {
            $sql="SELECT * FROM $this->table where category like :category or subCategory like :subCategory or productName like :productName";
//            $sql="SELECT * FROM $this->table where category like ? or subCategory like ? or productName like ?";
            $stmt=DB::prepare($sql);
            $key='%'.$key.'%';
            $stmt->bindParam(':category',$key);
            $stmt->bindParam(':subCategory',$key);
            $stmt->bindParam(':productName',$key);

//            $stmt->bindParam(1,$g);
//            $stmt->bindParam(2,$g);
//            $stmt->bindParam(3,$g);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>
import axios from "axios";

const BASE_URL = "http://127.0.0.1:8000/api/produk/"

class ProdukService{

    getProduk(){
        return axios.get(BASE_URL+'all');
    }

    findById(id){
        return axios.get(BASE_URL+id);
    }

    storeProduk(produk){
        return axios.post(BASE_URL+'create',produk);
    }   

    updateProduk(id, produk){
        return axios.put(BASE_URL + 'update/' + id,produk);
    }

    deleteProduk(id){
        return axios.delete(BASE_URL + 'delete/' + id);
    }

    createOrUpdate(produk){
        return axios.post(BASE_URL + 'store',produk);
    }


}


export default new ProdukService();
import React, { Component } from "react";
import Table from 'react-bootstrap/Table';
import ProdukService from "../services/ProdukService";
import Button from 'react-bootstrap/Button';
import Swal from 'sweetalert2'

class listProduk extends Component{
    constructor(props){
        super(props)
        this.state = {
            produks: [],
        }
    }
    componentDidMount(){
        ProdukService.getProduk().then((res) => {
            this.setState({ produks: res.data.data});
        });
    }

    deleteProduk(id){
        Swal.fire({
            title: 'Hapus Produk?',
            text: "Apakah kamu ingin menghapus Produk?!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Hapus Produk!'
        }).then((result) => {
            if (result.isConfirmed) {
                ProdukService.deleteProduk(id).then((res) => {
                    this.setState({produks: this.state.produks.filter(produk => produk.id !== id)});
                });
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }


    render(){
        return(
          <div>
            <Table striped bordered hover>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    {this.state.produks.map((produk, i) =>
                        <tr key = {produk.id}>
                            <td>{i+1}</td>
                            <td>{ produk.nama}</td>
                            <td>{ produk.keterangan}</td>
                            <td>{ produk.harga}</td>
                            <td>{ produk.persediaan}</td>
                            <td >
                                <div className="row d-flex">
                                    <div className="col-6 p-0 ">
                                        <Button variant="primary" onClick={() => this.props.updateFunction(produk.id)}>Ubah</Button>
                                    </div>
                                    <div className="col-6 p-0">
                                        <Button variant="danger" onClick={() => this.deleteProduk(produk.id)}>Hapus</Button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        )
                    }
                </tbody>
            </Table>

          </div>
        )
    }

}

export default listProduk;

import React, { Component  } from "react";
import Card from 'react-bootstrap/Card';
import CardHeader from 'react-bootstrap/esm/CardHeader';
import ProdukService from "../services/ProdukService";
import Form from 'react-bootstrap/Form';
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';
import Swal from 'sweetalert2'


class Main extends Component{

    constructor(props){
        super(props)
        this.state = {
            id:'',
            nama:'',
            keterangan:'',
            harga:'',
            persediaan:'',
            produks: [],
        }
    }

    validate = (values) => {
        const errors = {};
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/i;
        if (!values.nama) {
          errors.nama = "Nama is required!";
        }

        return errors;
    };

    
    componentDidMount(){
        ProdukService.getProduk().then((res) => {
            this.setState({ produks: res.data.data});
        });
    }

    update= (id) =>{
        ProdukService.findById(id).then((res) => {
            this.setState({id:res.data.data.id})
            this.setState({nama:res.data.data.nama})
            this.setState({keterangan:res.data.data.keterangan})
            this.setState({harga:res.data.data.harga})
            this.setState({persediaan:res.data.data.persediaan})
        });
    }

    updateOrCreate = (e) => {
        let produk = {id:this.state.id,nama: this.state.nama, keterangan: this.state.keterangan, harga:this.state.harga,persediaan:this.state.persediaan};
        this.validate(produk)

        ProdukService.createOrUpdate(produk).then((res) => {
            this.setState({ produks: res.data.payload});
        }).catch((exception) => {
            Swal.fire(
                'Error',
                exception.response.data.message,
                'error'
            )
        });
        this.setState({id:''})
        this.setState({nama:''})
        this.setState({keterangan:''})
        this.setState({harga:''})
        this.setState({persediaan:''})
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
            
            <div className="container-fluid p-lg-4">
                <Card>
                    <CardHeader className="p-lg-4">
                        <Card.Title>Daftar Produk Open Access</Card.Title>
                    </CardHeader>
                    <CardHeader>
                        <Form>
                            <div className="row m-2">
                                <div className="col-6">
                                    <Form.Control name="nama" placeholder="Nama Produk" value={this.state.nama} onChange={(e) => {this.setState({nama:e.target.value})}}/>
                                </div>
                                <div className="col-6">
                                    <Form.Control placeholder="Keterangan" value={this.state.keterangan} onChange={(e) => {this.setState({keterangan:e.target.value})}} />
                                </div>
                            </div>
                            <div className="row m-2">
                                <div className="col-6">
                                    <Form.Control placeholder="Harga" value={this.state.harga} onChange={(e) => {this.setState({harga:e.target.value})}} />
                                </div>
                                <div className="col-6">
                                    <Form.Control placeholder="Persediaan" value={this.state.persediaan} onChange={(e) => {this.setState({persediaan:e.target.value})}} />
                                </div>
                            </div>
                            <button className="btn btn-primary float-end mx-4 my-2" type="button" onClick={this.updateOrCreate}> Simpan</button>
                        </Form>
                    </CardHeader>
                    <Card.Body>
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
                                                    <Button variant="primary" onClick={() => this.update(produk.id)}>Ubah</Button>
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
                    </Card.Body>
                </Card>
            </div>
        )
    }
}


export default Main;

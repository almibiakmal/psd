<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sekolah;

class SekolahCrud extends Component
{
    public $sekolahs, $nama, $alamat, 
    $pemilikRekening, $nomorRekening, $bank, $email, $hp, $sekolah_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->sekolahs = Sekolah::all();
        return view('livewire.sekolah.sekolah-crud');
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->nama = '';
        $this->alamat = '';
        $this->pemilikRekening = '';
        $this->nomorRekening = '';
        $this->bank = '';
        $this->email = '';
        $this->hp = '';
    }
    
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'pemilikRekening' => 'required',
            'nomorRekening' => 'required',
            'bank' => 'required',
            'email' => 'required',
            'hp' => 'required'
        ]);
    
        Sekolah::updateOrCreate(['id' => $this->sekolah_id], [
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'pemilik_rekening' => $this->pemilikRekening,
            'nomor_rekening' => $this->nomorRekening,
            'bank' => $this->bank,
            'email' => $this->email,
            'handphone' => $this->hp
        ]);

        session()->flash('message', $this->sekolah_id ? 'Data updated successfully.' : 'Data added successfully.');

        $this->closeModal();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $this->sekolah_id = $id;
        $this->nama = $sekolah->nama;
        $this->alamat = $sekolah->alamat;
        $this->pemilikRekening = $sekolah->pemilik_rekening;
        $this->nomorRekening = $sekolah->nomor_rekening;
        $this->bank = $sekolah->bank;
        $this->email = $sekolah->email;
        $this->hp = $sekolah->handphone;
    
        $this->openModal();
    }
    
    public function delete($id)
    {
        Sekolah::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }
}

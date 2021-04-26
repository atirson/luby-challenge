import { FormEvent, useState } from 'react';
import Modal from 'react-modal';
import closeImg from '../../assets/close.svg';
import { Container } from './styles';
import { useStudents } from '../../hooks/useStudents';

interface NewStudentModalProps {
  isOpen: boolean;
  onRequestClose: () => void;
}

export function NewStudentModal({isOpen, onRequestClose}: NewStudentModalProps) {
  const {createStudent} = useStudents();

  const [name, setName] = useState('');
  const [series, setSerie] = useState('');
  const [gender, setGender] = useState('');
  const [age, setAge] = useState('');  
  const [cpf, setCpf] = useState('');
  const [phone, setPhone] = useState('');
  const [address, setAddress] = useState('');


  async function handleCreateNewStudent(event: FormEvent) {
    event.preventDefault();
    await createStudent({
      name,
      series,
      gender,
      age,
      cpf,
      phone,
      address
    });
    setName('');
    setSerie('');
    setGender('');
    setAge('');
    setCpf('');
    setPhone('');
    setAddress('');
    onRequestClose();
  }


  return (
    <Modal 
    isOpen={isOpen}
    onRequestClose={onRequestClose}
    overlayClassName="react-modal-overlay"
    className="react-modal-content"
  >
    
    <button type="button" onClick={onRequestClose} className="react-modal-close">
      <img src={closeImg} alt="Fechar Modal"/>
    </button>

    <Container onSubmit={handleCreateNewStudent}>
      <h2>Cadastrar novo Aluno</h2>

      <input 
        placeholder="Name" 
        value={name}
        onChange={event => setName(event.target.value)}
      />

      <input 
        type="number"
        placeholder="Serie" 
        value={series}
        onChange={event => setSerie(event.target.value)}
      />

      <input 
        placeholder="Gender" 
        value={gender}
        onChange={event => setGender(event.target.value)}
      />

      <input 
        type="number"
        placeholder="Age" 
        value={age}
        onChange={event => setAge(event.target.value)}
      />

      <input 
        placeholder="CPF" 
        value={cpf}
        onChange={event => setCpf(event.target.value)}
      />

      <input 
        placeholder="Phone" 
        value={phone}
        onChange={event => setPhone(event.target.value)}
      />

      <input 
        placeholder="Address" 
        value={address}
        onChange={event => setAddress(event.target.value)}
      />

      <button type="submit">
        Cadastrar
      </button>

    </Container>
    
  </Modal>

  )
}
import { useStudents } from '../../hooks/useStudents';
import { Container } from "./styles";
import { FaTrash, FaPencilAlt } from 'react-icons/fa';

export function StudentTable() {
  const {students, deleteStudent} = useStudents();

  return (
    <Container>
      <table>
        <thead>
          <tr>
            <th>Aluno</th>
            <th>Matrícula</th>
            <th>CPF</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          {students.map(student => (
            <tr key={student.id}>
              <td>{student.name}</td>
              <td>{student.number_registration}</td>
              <td>{student.cpf}</td>
              <td>
                <FaTrash 
                  onClick={() => deleteStudent(student.id)} 
                  style={{marginRight: '20px', cursor: 'pointer'}}
                />
                <FaPencilAlt />
              </td>
            </tr>
          ))}
          
          
        </tbody>
      </table>
    </Container>
  )
}
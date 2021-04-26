import { createContext, ReactNode, useEffect, useState, useContext } from 'react';
import { api, token } from '../services/api';

interface Student {
  id: string,
  number_registration: number,
  name: string,
  series: string,
  gender: string,
  age: string,
  cpf: string;
  phone: string;
  address: string;
}

type StudentInput = Omit<Student, 'id' | 'createdAt' | 'number_registration'>;

interface StudentsProviderProps {
  children: ReactNode;
} 

interface StudentsContextData {
  students: Student[];
  createStudent: (student: StudentInput) => Promise<void>;
  deleteStudent: (id: string) => Promise<void>;
}

const StudentsContext = createContext<StudentsContextData>({} as StudentsContextData);

export function StudentsProvider({children}: StudentsProviderProps) {
  const [students, setStudents] = useState<Student[]>([]);

  useEffect(() => {
    api.get('student/list', {
      headers: {
        'Authorization': `Bearer ${token}` 
      }
    })
      .then(response => setStudents(response.data.students))  
  }, []);

  console.log(students);

  async function deleteStudent(id: string): Promise<void> {
    await api.delete('student/delete', {
      headers: {
        'Authorization': `Bearer ${token}` 
      },
      data: {
        id
      }
    });

    await api.get('student/list', {
      headers: {
        'Authorization': `Bearer ${token}` 
      }
    })
      .then(response => setStudents(response.data.students));
  }


  async function createStudent(studentInput: StudentInput) {
    await api.post('/student/create', {
      ...studentInput,
      createdAt: new Date()
    },
    {
      headers: {
        'Authorization': `Bearer ${token}`
      },
    }
    );

    await api.get('student/list', {
      headers: {
        'Authorization': `Bearer ${token}` 
      }
    })
      .then(response => setStudents(response.data.students));
  }

  return (
    <StudentsContext.Provider value={{students, createStudent, deleteStudent}}>
      {children}
    </StudentsContext.Provider>
  )
}


export function useStudents() {
  const context = useContext(StudentsContext);

  return context;
}

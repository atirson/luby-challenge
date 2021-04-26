import React, { useState } from 'react';
import Modal from 'react-modal';

import { Dashboard } from "./components/Dashboard";
import { Header } from "./components/Header";
import { NewStudentModal } from './components/NewStudentModal';
import { GlobalStyle } from "./styles/global";
import { StudentsProvider } from './hooks/useStudents';

Modal.setAppElement('#root');

export function App() {
  const [isNewStudentModalOpen, setIsNewStudentModalOpen] = useState(false);

  function handleOpenNewStudentModal() {
    setIsNewStudentModalOpen(true);
  }

  function handleCloseNewStudentModal() {
    setIsNewStudentModalOpen(false);
  }


  return (
    <StudentsProvider>
      <Header onOpenNewFormStudent={handleOpenNewStudentModal}/>
      <Dashboard />

    <NewStudentModal 
      isOpen={isNewStudentModalOpen}
      onRequestClose={handleCloseNewStudentModal}
    />

      <GlobalStyle />
    </StudentsProvider>
  );
}

import logoImg from '../../assets/logo.png';
import { Container, Content } from './styles';

interface HeaderProps {
  onOpenNewFormStudent: () => void;
}

export function Header({ onOpenNewFormStudent }: HeaderProps) {
  
  return (
    <Container>
      <Content>
        <img src={logoImg} alt="luby"/>
        <button type="button" onClick={onOpenNewFormStudent}>Novo Aluno</button>
      </Content>
    </Container>
  )
}
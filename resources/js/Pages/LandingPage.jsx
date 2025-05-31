import { Button } from '@/components/ui/button';
import { Link } from 'react-router-dom';

export default function Landing() {
  return (
    <div className="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-100 to-white p-4">
      <h1 className="text-4xl font-bold mb-6">Welcome to JobFlow</h1>
      <div className="flex gap-4">
        <Link to="/login">
          <Button variant="default">Login</Button>
        </Link>
        <Link to="/register">
          <Button variant="outline">Register</Button>
        </Link>
      </div>
    </div>
  );
}

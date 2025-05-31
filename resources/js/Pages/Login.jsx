import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Link } from 'react-router-dom';
import { useState } from 'react';

export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log({ email, password });
    // Kirim ke backend pakai fetch/Axios nanti
  };

  return (
    <div className="min-h-screen flex flex-col items-center justify-center bg-white p-4">
      <h2 className="text-2xl font-semibold mb-6">Login</h2>
      <form onSubmit={handleSubmit} className="w-full max-w-sm space-y-4">
        <Input type="email" placeholder="Email" value={email} onChange={e => setEmail(e.target.value)} required />
        <Input type="password" placeholder="Password" value={password} onChange={e => setPassword(e.target.value)} required />
        <Button type="submit" className="w-full">Login</Button>
        <p className="text-sm text-center mt-2">
          Belum punya akun? <Link to="/register" className="text-blue-600 hover:underline">Register</Link>
        </p>
      </form>
    </div>
  );
}

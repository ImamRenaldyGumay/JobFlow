import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Link } from 'react-router-dom';
import { useState } from 'react';

export default function Register() {
  const [form, setForm] = useState({ name: '', email: '', password: '' });

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log(form);
    // Kirim ke backend pakai fetch/Axios nanti
  };

  return (
    <div className="min-h-screen flex flex-col items-center justify-center bg-white p-4">
      <h2 className="text-2xl font-semibold mb-6">Register</h2>
      <form onSubmit={handleSubmit} className="w-full max-w-sm space-y-4">
        <Input placeholder="Name" value={form.name} onChange={e => setForm({ ...form, name: e.target.value })} required />
        <Input type="email" placeholder="Email" value={form.email} onChange={e => setForm({ ...form, email: e.target.value })} required />
        <Input type="password" placeholder="Password" value={form.password} onChange={e => setForm({ ...form, password: e.target.value })} required />
        <Button type="submit" className="w-full">Register</Button>
        <p className="text-sm text-center mt-2">
          Sudah punya akun? <Link to="/login" className="text-blue-600 hover:underline">Login</Link>
        </p>
      </form>
    </div>
  );
}

function App() {
  return (
    <div className="min-h-screen flex flex-col">
      <header className="border-b border-slate-800 bg-slate-950/80 backdrop-blur">
        <div className="max-w-5xl mx-auto px-4 h-16 flex items-center justify-between">
          <span className="text-slate-200 font-semibold tracking-tight">
            robin-hourtane.dev
          </span>
          <nav className="hidden gap-6 text-sm text-slate-400 md:flex">
            <a href="#" className="hover:text-slate-100 transition-colors">
              _home
            </a>
            <a href="#" className="hover:text-slate-100 transition-colors">
              _projects
            </a>
            <a href="#" className="hover:text-slate-100 transition-colors">
              _about
            </a>
            <a href="#" className="hover:text-slate-100 transition-colors">
              _contact
            </a>
          </nav>
        </div>
      </header>

      <main className="flex-1 flex items-center">
        <section className="max-w-5xl mx-auto px-4 py-12 grid gap-10 md:grid-cols-2">
          <div className="space-y-6">
            <p className="text-sm text-emerald-400 font-mono">
              &gt; Bonjour, je suis
            </p>
            <h1 className="text-4xl font-semibold tracking-tight text-slate-50 md:text-5xl">
              Robin Hourtané
            </h1>
            <h2 className="text-lg font-mono text-sky-400">
              _full stack developer
            </h2>
            <p className="text-sm text-slate-400 max-w-md">
              Portfolio en cours de réécriture avec{' '}
              <span className="text-sky-400 font-mono">React</span> et{' '}
              <span className="text-emerald-400 font-mono">Tailwind CSS</span>.
              Tu peux modifier ce composant dans{' '}
              <code className="px-1.5 py-0.5 rounded bg-slate-900 border border-slate-800 text-xs">
                src/App.jsx
              </code>
              .
            </p>
            <div className="flex flex-wrap gap-3">
              <button className="px-4 py-2 rounded-md bg-emerald-500 text-slate-950 text-sm font-medium hover:bg-emerald-400 transition-colors">
                Voir les projets (bientôt)
              </button>
              <button className="px-4 py-2 rounded-md border border-slate-700 text-sm text-slate-200 hover:border-slate-500 hover:bg-slate-900 transition-colors">
                Ouvrir le code
              </button>
            </div>
          </div>

          <div className="hidden md:block">
            <div className="relative">
              <div className="absolute -top-10 -right-10 h-40 w-40 rounded-full bg-emerald-500/10 blur-3xl" />
              <div className="absolute -bottom-10 -left-10 h-40 w-40 rounded-full bg-sky-500/10 blur-3xl" />
              <div className="relative rounded-xl border border-slate-800 bg-slate-900/80 p-4 font-mono text-xs text-slate-300 shadow-[0_0_40px_rgba(15,23,42,0.8)]">
                <p className="text-slate-500 mb-2">// profile.config.ts</p>
                <pre className="space-y-1">
                  <code>{`const robin = {`}</code>
                  <code className="block pl-4">
                    name: <span className="text-emerald-400">"Robin Hourtané"</span>,
                  </code>
                  <code className="block pl-4">
                    role:{' '}
                    <span className="text-emerald-400">
                      "Full Stack Developer"
                    </span>
                    ,
                  </code>
                  <code className="block pl-4">
                    stack:{' '}
                    <span className="text-sky-400">["React", "PHP", "MySQL"]</span>,
                  </code>
                  <code className="block pl-4">
                    location: <span className="text-emerald-400">"France"</span>,
                  </code>
                  <code>{`}`}</code>
                </pre>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  )
}

export default App

<div>
    <main>
        <div class="container">
          <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
    
                  <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                      <img src="assets/img/logo.png" alt="">
                      <span class="d-none d-lg-block">NiceAdmin</span>
                    </a>
                  </div>
    
                  <div class="card card-animated mb-3">
                    <div class="card-body">
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Criar uma conta</h5>
                        <p class="text-center text-primary small"><b>Preencha os campos</b></p> <hr>
                      </div>
    
                      <form class="row g-3 needs-validation" novalidate>
                        <div class="col-12">
                          <label for="yourName" class="form-label">Your Name</label>
                          <input type="text" name="name" class="form-control" id="yourName" required>
                          <div class="invalid-feedback">Please, enter your name!</div>
                        </div>
    
                        <div class="col-12">
                          <label for="yourEmail" class="form-label">Your Email</label>
                          <input type="email" name="email" class="form-control" id="yourEmail" required>
                          <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                        </div>
    
                        <div class="col-12">
                          <label for="yourUsername" class="form-label">Username</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
    
                        <div class="col-12">
                          <label for="yourPassword" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="yourPassword" required>
                          <div class="invalid-feedback">Please enter your password!</div>
                        </div>
    
                        <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                            <label class="form-check-label" for="acceptTerms">Eu concordo e aceito com <a href="#">termos e condições</a></label>
                            <div class="invalid-feedback">Você deve concordar antes de submeter.</div>
                          </div>
                        </div>
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Criar conta</button>
                        </div>
                        <div class="col-12">
                          <p class="small mb-0">Você já tem uma conta? <a href="/autenticacao"><b>Autenticar-se</b></a></p>
                        </div>
                      </form>
    
                    </div>
                  </div>
    
                  <div class="credits">
                    Designed by <a href="">BootstrapMade</a>
                  </div>
    
                </div>
              </div>
            </div>
    
          </section>
    
        </div>
      </main>
</div>

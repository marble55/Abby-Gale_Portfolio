<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- --------- ICONS ---------- -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <!-- --------- LOGO ---------- -->
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">

    <title>My Portfolio</title>
</head>

<body>
    <div class="container">
        <!-- --------------- HEADER --------------- -->
        <nav id="header">
            <div class="nav-logo">
                <p class="nav-name">{{ $hero->name }}</p>
                <span>.</span>
            </div>
            <div class="nav-menu" id="myNavMenu">
                <ul class="nav_menu_list">
                    <li class="nav_list">
                        <a href="#home" class="nav-link active-link">Home</a>
                        <div class="circle"></div>
                    </li>
                    <li class="nav_list">
                        <a href="#about" class="nav-link">About</a>
                        <div class="circle"></div>
                    </li>
                    <li class="nav_list">
                        <a href="#projects" class="nav-link">Projects</a>
                        <div class="circle"></div>
                    </li>
                    <li class="nav_list">
                        <a href="#contact" class="nav-link">Contact</a>
                        <div class="circle"></div>
                    </li>
                </ul>
            </div>
            <div class="nav-button">
                <a href="{{ $cv_path ?? '#' }}" download="cv_file_name.pdf" class="btn">Download CV <i
                        class="uil uil-file-alt"></i></a>
            </div>
            <div class="nav-menu-btn">
                <i class="uil uil-bars" onclick="myMenuFunction()"></i>
            </div>
        </nav>


        <!-- -------------- MAIN ---------------- -->
        <main class="wrapper">
            <!-- -------------- FEATURED BOX ---------------- -->
            <section class="featured-box" id="home">
                <div class="featured-text">
                    <div class="featured-text-card">
                        <span>HELLO</span>
                    </div>
                    <div class="featured-name">
                        <p>I'm {{ $hero->name ?? '' }} <br> an aspiring <br><span class="typedText"></span></p>
                    </div>
                    <div class="featured-text-info">
                        <p>
                            {{ $hero->description ?? '' }}
                        </p>
                    </div>
                    <div class="featured-text-btn">
                        <button class="btn blue-btn">Hire Me</button>
                        <a href="{{ $cv_path ?? '#' }}" download="AbbyGale_CV.pdf" class="btn">Download CV <i
                                class="uil uil-file-alt"></i></a>
                    </div>
                    <div class="social_icons">
                        <a href="https://www.instagram.com/bbyyy.gl_" target="_blank" rel="noopener noreferrer"
                            class="icon"><i class="uil uil-instagram"></i></a>
                        <a href="https://www.facebook.com/abbygale.seneres" target="_blank" rel="noopener noreferrer"
                            class="icon"><i class="uil uil-facebook"></i></a>
                        <a href="https://twitter.com/sim_bby_gl" target="_blank" rel="noopener noreferrer"
                            class="icon"><i class="uil uil-twitter"></i></a>
                        <a href="https://github.com/ABBYYYYYYYY" target="_blank" rel="noopener noreferrer"
                            class="icon"><i class="uil uil-github-alt"></i></a>
                    </div>
                </div>
                <div class="featured-image">
                    <div class="image">
                        <img src="{{ $hero->picture_path ?? '/images/avatar.png' }}" alt="avatar">
                    </div>
                </div>
                <div class="scroll-icon-box">
                    <a href="#about" class="scroll-btn">
                        <i class="uil uil-mouse-alt"></i>
                        <p>Scroll Down</p>
                    </a>
                </div>
            </section>

            <!-- -------------- ABOUT BOX ---------------- -->
            <section class="section" id="about">
                <div class="top-header">
                    <h1>About Me</h1>
                </div>
                <div class="row">
                    <div class="about-col-1">
                        <img src="{{ $about->image_path ?? URL::asset('images/avatar.png') }}" alt=""
                            class="about-img">
                    </div>
                    <div class="about-col-2">
                        <div class="about-info">
                            <h3 class="sub-title">My introduction</h3>
                            <p>{{ $about->description }}</p>
                            <div class="about-btn">
                                <a href="{{ $cv_path ?? '#' }}" download="AbbyGale_CV.pdf" class="btn">Download CV <i
                                        class="uil uil-file-alt"></i></a>
                            </div>
                        </div>
                        <div class="my-background">
                            <div class="tab-titles">
                                <p class="tab-links" onclick="opentab('skills')">Skills</p>
                                <p class="tab-links" onclick="opentab('interests')">Interests</p>
                                <p class="tab-links" onclick="opentab('education')">Education</p>

                            </div>

                            <div class="tab-contents active-tab" id="skills">
                                <ul>
                                    @foreach ($skills as $skill)
                                        <li>
                                            @if ($skill->image_path)
                                                <img src="{{ $skill->image_path ?? '/images/ktmsces.png' }}">
                                            @else
                                                <i class="{{ $skill->icon_path }}"></i>
                                            @endif
                                            <span>{{ $skill->title }}</span><br>
                                            <p>{{ $skill->description }}</p>
                                        </li>
                                    @endforeach

                                    {{-- pwede lang na sila remove --}}
                                    <li><span>UI/UX</span><br>Designing Web/App Interfaces</li>
                                    <li><span>Web Development</span><br>Web app Development</li>
                                    <li><span>App Development</span><br>Building Android/IOS apps</li>
                                </ul>
                            </div>
                            <div class="tab-contents" id="interests">
                                <ul>
                                    @foreach ($interests as $interest)
                                        <li>
                                            @if ($interest->image_path)
                                                <img src="{{ $interest->image_path ?? '/images/ktmsces.png' }}">
                                            @else
                                                <i class="{{ $interest->icon_path }}"></i>
                                            @endif
                                            <span>{{ $interest->title }}</span><br>
                                            <p>{{ $interest->description }}</p>
                                        </li>
                                    @endforeach

                                    {{-- pwede lang na sila remove --}}
                                    <li><span>Anime</span><br>I typically like romance, drama, slice of life, mystery,
                                        and
                                        comedy genres</li>
                                    <li><span>Singing</span><br>I learned to sing by listening to BTS back in 8th grade
                                    </li>
                                    <li><span>Video Games</span><br>I play Ace Attorney, Minecraft, Overcooked 2</li>
                                </ul>
                            </div>
                            <div class="tab-contents" id="education">
                                <div class="education-item">
                                    <ul>
                                        @foreach ($educations as $education)
                                            <li>
                                                @if ($education->image_path)
                                                    <img src="{{ $education->image_path ?? '/images/ktmsces.png' }}">
                                                @else
                                                    <i class="{{ $education->icon_path }}"></i>
                                                @endif
                                                <span>{{ $education->title }}</span><br>
                                                <p>{{ $education->description }}</p>
                                            </li>
                                        @endforeach

                                        {{-- pwede lang na sila remove --}}
                                        <li>
                                            <img src="/images/ktmsces.png">
                                            <span>2012-2016:Elementary</span><br>
                                            <p>Kapitan Tomas Monteverde Sr. Central Elementary School</p>
                                        </li>

                                        <li><img src="/images/dranhs.png">
                                            <span>2016-2020: Junior High School</span><br>
                                            <p>Daniel R. Aguinaldo National High School</p>
                                        </li>

                                        <li><img src="/images/pwc.png"><span>2020-2022: Senior High
                                                School</span><br>Philippine Women's College of
                                            Davao
                                        </li>

                                        <li><img src="/images/usep-logo2.png"><span>2022-Present:
                                                College</span><br>University of Southeastern Philippines
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>

            <!-- -------------- PROJECT BOX ---------------- -->

            <section class="section" id="projects">
                <div class="top-header">
                    <h1>Projects</h1>
                </div>
                <div class="project-container">
                    @foreach ($projects as $project)
                        <div class="project-box">
                            <img src="{{ $project->image_path ?? '/images/Genealogy & Timeline of Humanity.png' }}" alt="Project Image 3">
                            <h3>{{ $project->title }}</h3>
                        </div>
                    @endforeach

                    <div class="project-box">
                        <img src="/images/Genealogy & Timeline of Humanity.png" alt="Project Image 3">
                        <h3>Genealogy</h3>

                    </div>
                    <div class="project-box">
                        <img src="/images/Proverbs App.png" alt="Project Image 2">
                        <h3>Proverbs Application</h3>

                    </div>
                    <div class="project-box">
                        <img src="/images/ElectriGuide.png" alt="Project Image 3">
                        <h3>ElectriGuide</h3>

                    </div>
                </div>
            </section>

            <!-- -------------- CONTACT BOX ---------------- -->

            <section class="section" id="contact">
                <div class="top-header">
                    <h1>Get in touch</h1>
                    <span>Do you have a project in your mind? Contact me here!</span>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="contact-info">
                            <h2>Find Me <i class="uil uil-corner-right-down"></i></h2>
                            <p><i class="uil uil-envelope"></i> Email: {{ $hero->email ?? 'agsseneres01651@usep.edu.ph' }}</p>
                            <p><i class="uil uil-phone"></i> Tel: {{ $hero->telephone ?? '+639558071317' }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-control">
                            <div class="form-inputs">
                                <input type="text" class="input-field" placeholder="Name">
                                <input type="text" class="input-field" placeholder="Email">
                            </div>
                            <div class="text-area">
                                <textarea placeholder="Message"></textarea>
                            </div>
                            <div class="form-button">
                                <button class="btn">Send <i class="uil uil-message"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>


        <!-- --------------- FOOTER --------------- -->
        <footer>
            <div class="top-footer">
                <p>Abby Gale .</p>
            </div>
            <div class="middle-footer">
                <ul class="footer-menu">
                    <li class="footer_menu_list">
                        <a href="#home">Home</a>
                    </li>
                    <li class="footer_menu_list">
                        <a href="#about">About</a>
                    </li>
                    <li class="footer_menu_list">
                        <a href="#projects">Projects</a>
                    </li>
                    <li class="footer_menu_list">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="footer-social-icons">
                <a href="https://www.instagram.com/bbyyy.gl_" target="_blank" rel="noopener noreferrer"
                    class="icon"><i class="uil uil-instagram"></i></a>
                <a href="https://www.facebook.com/abbygale.seneres" target="_blank" rel="noopener noreferrer"
                    class="icon"><i class="uil uil-facebook"></i></a>
                <a href="https://twitter.com/sim_bby_gl" target="_blank" rel="noopener noreferrer" class="icon"><i
                        class="uil uil-twitter"></i></a>
                <a href="https://github.com/ABBYYYYYYYY" target="_blank" rel="noopener noreferrer" class="icon"><i
                        class="uil uil-github-alt"></i></a>
            </div>
            <div class="bottom-footer">
                <p>Copyright &copy; <a href="#home" style="text-decoration: none; color: #f8124c;">Abby Gale</a> -
                    All
                    rights reserved
                </p>
            </div>
        </footer>

    </div>




    <!-- ----- TYPING JS Link ----- -->
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>

    <!-- ----- SCROLL REVEAL JS Link----- -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- ----- MAIN JS ----- -->
    <script src="js/app.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        var tablinks = document.getElementsByClassName("tab-links");
        var tabcontents = document.getElementsByClassName("tab-contents");

        function opentab(tabname) {
            for (tablink of tablinks) {
                tablink.classList.remove("active-link");
            }
            for (tabcontent of tabcontents) {
                tabcontent.classList.remove("active-tab");
            }
            event.currentTarget.classList.add("active-link")
            document.getElementById(tabname).classList.add("active-tab");
        }

        function myMenuFunction() {
            var menuBtn = document.getElementById("myNavMenu");

            if (menuBtn.className === "nav-menu") {
                menuBtn.className += " responsive";
            } else {
                menuBtn.className = "nav-menu";
            }
        }
    </script>
</body>

</html>

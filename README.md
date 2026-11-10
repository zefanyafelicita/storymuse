# StoryMuse

**Discover Stories Beyond the Trending Page.**

## 1. Project Description

StoryMuse is a web-based Wattpad story discovery and recommendation platform that helps readers discover interesting stories, including hidden gems that receive less attention despite their potential quality.

The project was developed to address the difficulty of discovering stories beyond popular or trending recommendations. Many potentially interesting stories may be overlooked because they have limited visibility or engagement.

StoryMuse provides features such as story discovery, hidden gem recommendations, personalized recommendations, story collections, and story details.

## 2. How to Run the Application

**Prerequisites:**
- Docker Desktop
- Git

**Installation steps:**

1. Clone the repository:

   ```bash
   git clone https://github.com/zefanyafelicita/storymuse.git
   cd storymuse
   ```

2. Create the environment file:

   ```powershell
   Copy-Item .env.example .env
   ```

3. Build and run the application:

   ```bash
   docker compose up -d --build
   ```

4. Open StoryMuse in your browser:

   ```text
   http://localhost:8080
   ```

5. Check container status:

   ```bash
   docker compose ps
   ```

6. Stop the containers:

   ```bash
   docker compose down
   ```

**Note:** Do not use `docker compose down -v` if you want to preserve database data.

## 3. Application Screenshots

Screenshots of the StoryMuse application:

- Home Page: `docs/screenshots/home.png`
- Discover Page: `docs/screenshots/discover.png`
- Hidden Gems Page: `docs/screenshots/hidden-gems.png`
- For You Page: `docs/screenshots/for-you.png`

## 4. Article and Demo Video

- **Project Article:** [StoryMuse: Building a Story Discovery Platform with Laravel, Docker, and Docker Compose](https://medium.com/@zefanyafelicita28/storymuse-building-a-story-discovery-platform-with-laravel-docker-and-docker-compose-363bdc15be64)
- **Demo Video:** [Watch StoryMuse Demo on YouTube](https://youtu.be/IiTV3n4JBFs)

## 5. AI Usage Declaration

AI tools were used as supporting tools during the development process, including:
- Brainstorming and refining project features.
- Assistance with backend implementation and API development.
- Docker configuration and troubleshooting guidance.
- Documentation writing and technical explanations.

All AI-assisted suggestions were reviewed, adapted, integrated, and tested by the developer. The developer remains responsible for the final implementation and project results.

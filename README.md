<a name="readme-top"></a>

<br />

<div align="center">
  <h3 align="center">E-mail marketing app (Domain Driven Design)</h3>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project

E-mail marketing application is software that store subsribers and allows us to send e-mails to them. But it also comes with a great set of more complex features,
such as:

Features:
* Managing subscribers.
* Tagging them. Tags are helpful to filter subscribers when you want to send e-mails.
* Sending broadcast (or one-time) e-mails. You write the content, set the filters, and hit
the Send button.
* Creating sequences. A sequence is a collection of e-mails delivered to subscribers after
a certain delay. For example, you write four e-mails, and you want to send these e-
mails in four weeks. You can create a sequence that does precisely that automatically.
And the great thing about sequences is that they handle new subscribers as well. So if
you create this sequence in February and a person subscribes in May, they will still be
added to it and get one e-mail per week.
* Adding subscribers to sequences based on specific criteria. We can also create
different filters. For example, we want to exclude subscribers who bought a particular
product or have a specific tag.
* Creating subscription forms where people can enter their e-mail addresses. You can
build an HTML form with an e-mail input that can be embedded into your site. If
someone submits this form, they will be added to your e-mail list.
* Tracking e-mail opens, and link clicks.
* Generating reports from these metrics.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



### Built With

* Laravel
* Vue JS
* Inertia

<p align="right">(<a href="#readme-top">back to top</a>)</p>


### Overview

#### Subscribers

Subscribers represent people in an e-mail list. Usually, a subscriber has an e-mail address
and other custom fields, like first name, last name, etc. A subscriber can be added to a list
in several different ways:
* Manually
* By submitting a subscription form
* Via CSV import

Subscribers can also have tags. Tags can be used to filter out people from a particular e-
mail. Let's say you have an e-mail list that contains people who haven't opened your e-
mails in the last six months. First, you query them and mark them with an inactive tag. Later, you can write an e-mail where you try to re-
engage with these people. When you send this e-mail, you want to apply a filter with the inactive tag, so only those subscribers will get it.

#### Broadcasts

Broadcasts are e-mails you want to send one time to a given set of subscribers. First, you
write the content and save it; after that, you either send it manually or schedule it for a later
time.

Metrics like these can track the performance of a sent broadcast:

* How many people got the mail.
* Open rate. How many people opened the mail.
* Click rate. How many people clicked on a link inside the content (if there's a link).

These rates can be expressed as percentage values, for example:

* 1000 sent mails
* 49% open rate (490 were opened)
* 8% click rate (80 were clicked)

#### Sequences

Sequences are one of the most powerful features of ConvertKit. Imagine you want to create
an e-mail course on Domain-Driven Design. You write eight e-mails with eight different
concepts and ideas. If you use broadcasts to do this, you get the following results:

* On the 1st of June, you have 1000 subscribers, and you send out the first mail.
* From the 1st through the 8th of July, you get 100 new subscribers. They haven't
  received the first mail because they joined your newsletter a few days later.
* On the 8th of July, you have 1100 subscribers, and you send out the second mail.

The 100 new subscribers never got the first e-mail. They started your course on the 2nd e-
mail. This is obviously not what we want.

A sequence is a set of e-mails grouped together. Using the DDD e-mail course as an
example, you can create a sequence like this:

Sequence name: Domain-Driven Design Course:

* 1st e-mail: What Is DDD?
* 2nd e-mail: Using DTOs
* 3rd e-mail: The Benefits of Value Objects

We want to send one e-mail per week but only on Wednesday. So we can specify delays
between each e-mail:
* 1st e-mail will be sent on the first Wednesday after you publish the sequence.
* 2nd e-mail will be sent on the 2nd Wednesday.
* 3rd e-mail will be sent on the 3rd Wednesday.

Each e-mail in the sequence can have custom subscriber filters; each subscriber has a
different status when consuming a sequence. Let's take a look at an example.

We have the following subscribers:

| Subscriber name  | Tags |
| ------------- | ------------- |
| Subscriber 1  | Tag 1 |
| Subscriber 2  | Tag 2 |
| Subscriber 3  | Tag 1, Tag 2 |
| Subscriber 4  | - |

Each e-mail will be sent a week after the previous one. The results will be:

![Sequence e-mails by subscribers](https://iili.io/JFDdRyv.png)

## User Stories

### Subscribers
| User story  | Description |
| ------------- | ------------- |
| Creating a subscriber  | Needs an API endpoint |
| Importing subscribers from CSV  | This as an "admin task" so it's gonna be a Console Command. |
| Filtering subscribers  | It's not really a user story but we need it in multiple places. |

### Broadcasts
| User story  | Description |
| ------------- | ------------- |
| Creating a broadcast  | With filters and content. |
| Sending a broadcast  | First it filters out the subscribers and then it queues up the e-mails. |

### Sequences
| User story  | Description |
| ------------- | ------------- |
| Creating a sequence  | With basic data such as title |
| Adding a sequence mail  | With filters and schedule (such as 3 days after the last mail). |
| Publishing a sequence  | It's just a state transition from draft to published. |
| Proceeding a sequence  | This will handle all the scheduling logic. It needs to be scheduled to run frequently. It will send the e-mails. |

### Tracking
| User story  | Description |
| ------------- | ------------- |
| Tracking e-mail openings  | It can be a broadcast or a sequence e-mail. Needs an API endpoint. |
| Tracking link clicks  | First it filters out the subscribers and then it queues up the e-mails. |

### Reports
| User story  | Description |
| ------------- | ------------- |
| Sequence progress  | Such as how many subscribers completed it. |
| New subscribers  | How many new subscribers are this week, this month, today, or in total |
| Daily new subscribers  | How many new subscribers we had on a daily basis. |
| Performance for sent mail  | Performance for a sent mail. |
| Performance for a whole sequence  | Aggregating the individual e-mails for a whole sequence. |

## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

### Prerequisites

This is an example of how to list things you need to use the software and how to install them.
* npm
  ```sh
  npm install npm@latest -g
  ```

### Installation

_Below is an example of how you can instruct your audience on installing and setting up your app. This template doesn't rely on any external dependencies or services._

1. Get a free API Key at [https://example.com](https://example.com)
2. Clone the repo
   ```sh
   git clone https://github.com/your_username_/Project-Name.git
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Enter your API in `config.js`
   ```js
   const API_KEY = 'ENTER YOUR API';
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- ROADMAP -->
## Roadmap
- [x] Subscribers domain
- [x] Broadcasts domain
- [x] Sequences domain
- [x] Add factories and seeders 
- [ ] Add reports
- [ ] Finish documentation
- [ ] Add missing backend tests
- [ ] Add missing frontend tests
- [ ] CI / CD pipeline
- [ ] Restructure frontend to be more DDD-ish
    - [ ] Restructure files
    - [ ] Simplify views

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#readme-top">back to top</a>)</p>

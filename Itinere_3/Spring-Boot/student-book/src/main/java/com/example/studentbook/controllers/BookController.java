package com.example.studentbook.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import com.example.studentbook.models.Book;
import com.example.studentbook.repositories.BookRepository;
import com.example.studentbook.repositories.StudentRepository;

@Controller
public class BookController {

    final BookRepository repo;
    StudentRepository repoStudent;

    public BookController(BookRepository repo, StudentRepository repoStudent) {
        this.repo = repo;
        this.repoStudent = repoStudent;
    }

    @GetMapping("books")
    public String index(Model model) {
        model.addAttribute("books", repo.findAll());
        return "books/index";
    }

    @GetMapping("books/create")
    public String create(Model model) {
        model.addAttribute("students", repoStudent.findAll());
        return "books/create";
    }
    
    @PostMapping("books/store")
    public String store(Book book) {
        repo.save(book);
        return "redirect:/books";
    }
    
    @GetMapping("books/show")
    public String show(Long id, Model model) {
        model.addAttribute("book", repo.findById(id).orElse(null));
        return "books/show";
    }

    @GetMapping("books/edit")
    public String edit(Long id, Model model) {
        model.addAttribute("students", repoStudent.findAll());
        model.addAttribute("book", repo.findById(id).orElse(null));
        return "books/edit";
    }

    @PostMapping("books/update")
    public String update(Book book) {
        repo.save(book);
        return "redirect:/books";
    }

    @PostMapping("books/delete")
    public String delete(Long id) {
        repo.deleteById(id);
        return "redirect:/books";
    }
}

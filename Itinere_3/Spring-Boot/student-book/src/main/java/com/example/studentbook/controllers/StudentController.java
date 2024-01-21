package com.example.studentbook.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;

import com.example.studentbook.models.Student;
import com.example.studentbook.repositories.StudentRepository;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

@Controller
public class StudentController {
    
    private final StudentRepository repo;

    public StudentController(StudentRepository repo) {
        this.repo = repo;
    }

    @GetMapping("/")
    public String home() {
        return "index";
    }

    @GetMapping("students")
    public String index(Model model) {
        model.addAttribute("students", repo.findAll());
        return "students/index";
    }

    @GetMapping("students/create")
    public String create() {
        return "students/create";
    }
    
    @PostMapping("students/store")
    public String store(Student student) {
        repo.save(student);
        return "redirect:/students";
    }
    
    @GetMapping("students/show")
    public String show(Long id, Model model) {
        model.addAttribute("student", repo.findById(id).orElse(null));
        return "students/show";
    }

    @GetMapping("students/edit")
    public String edit(Long id, Model model) {
        model.addAttribute("student", repo.findById(id).orElse(null));
        return "students/edit";
    }

    @PostMapping("students/update")
    public String update(Student student) {
        repo.save(student);
        return "redirect:/students";
    }

    @PostMapping("students/delete")
    public String delete(Long id) {
        repo.deleteById(id);
        return "redirect:/students";
    }
}

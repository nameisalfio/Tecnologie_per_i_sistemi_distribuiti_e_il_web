package com.example.department_employee.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

import com.example.department_employee.Repositories.DepartmentReposity;
import com.example.department_employee.models.Department;

@Controller
public class DepartmentController {
    private final DepartmentReposity repo;

    public DepartmentController(DepartmentReposity repo){
        this.repo = repo;
    }

    @GetMapping("/")
    String welcome(){
        return "/welcome";
    }

    @GetMapping("/departments")
    String index(Model model){
        model.addAttribute("departments", repo.findAll());
        return "/departments/index";
    }

    @GetMapping("/departments/create")
    String create(){
        return "/departments/create";
    }

    @PostMapping("/departments/store")
    String store(Department department){
        repo.save(department);
        return "redirect:/departments";
    }

    @GetMapping("/departments/show")
    String show(Model model, Long id){
        model.addAttribute("d", repo.findById(id).orElse(null));
        return "/departments/show";
    }

    @GetMapping("/departments/edit")
    String edit(Model model, Long id){
        model.addAttribute("d", repo.findById(id).orElse(null));
        return "/departments/edit";
    }

    @PostMapping("/departments/update")
    String update(Department department){
        repo.save(department);
        return "redirect:/departments";
    }

    @PostMapping("/departments/destroy")
    String destroy(Department department){
        repo.deleteById(department.getId());
        return "redirect:/departments";
    }
}

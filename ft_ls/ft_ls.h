/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:02:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/21 00:37:02 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LS_H
# define FT_LS_H
# include <dirent.h>
# include <sys/types.h>
# include <sys/stat.h>
# include <pwd.h>
# include <uuid/uuid.h>
# include <grp.h>
# include <sys/xattr.h>
# include <time.h>
# include <stdio.h>
# include "libft/libft.h"

# define F_DETAIL 1
# define F_RECURS 2
# define F_ALL 4
# define F_REVERSE 8
# define F_TIME 16

# define F_DIR (char)'d'
# define F_LINK (char)'l'

# define DEBUG printf

typedef struct			s_entry {
	int					init;
	struct s_file		*first;
	struct s_file		*file;
	int					count;
	int					max;
	char				*name;
}						t_entry;

typedef struct			s_file {
	char				*name;
	struct s_file		*next;
	struct dirent		*dirent;
	int					id;
	int					name_size;
}						t_file;

typedef struct			s_opt {
	int					flag;
	struct s_entry		*entries;
	struct s_entry		*files;
	struct s_entry		*folders;
	struct s_entry		*tmp_dir;
}						t_opt;

typedef struct			s_infos {
	char				*name;
	char				*mode;
	struct stat			stat;
	struct dirent		*dirent;
	struct passwd		*uid;
	struct group		*gid;
}						t_infos;

void					print_nexist(char *path);

int						is_regular_file(const char *path);
int						is_folder(const char *path);
int						exist(const char *path);

void					free_entries(t_entry *entry);
void					free_file(t_file *file);
void					free_opt(t_opt *opt);

t_file					*new_file(char *name, struct dirent *dir);
void					add_file(t_entry *entry, char *str, \
						struct dirent *dir);
t_entry					*new_entry(void);
t_opt					*new_opt(void);
t_file					*get_file(t_file *first, int id);

int						set_flag(char c_flag, t_opt *opt);
int						parse(char **argv, t_opt *opt);
void					set_opt_folders(t_opt *opt, int argc, \
						char **argv, int index);

void					print(t_opt *opt, t_file *file, t_infos *infos, int size_max);
void					print_details(t_opt *opt, t_infos *infos, \
						int size_max);
void					display_folder(t_opt *opt, t_entry *entry);
void					display(t_opt *opt, t_entry *entry);
void					print_ls(t_opt *opt);

t_infos					*get_infos(char *path, struct dirent *dirent);
void					read_folders(t_opt *opt);

void					split_entries(t_opt *opt);
void					max_size(t_opt *opt);
void					swap(t_file *a, t_file *b);
void					quicksort(t_entry *entry, int low, int high);

char					get_dtype(int type);
char					*get_color(int mode);
char					*get_mode(int mode, unsigned char type);
int						has_flag(t_opt *opt, int flag);

#endif

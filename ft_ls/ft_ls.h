/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:02:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/23 13:50:27 by malallai         ###   ########.fr       */
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
# define F_BLOCKS 32

# define WHITE (char *)"\033[0m"
# define CYAN (char *)"\033[1;36m"
# define RED (char *)"\033[0;31m"
# define PURPLE (char *)"\033[0;35m"

# define GREEN (char *)"\033[38;5;118m"
# define YELLOW (char *)"\033[38;5;226m"

# define F_DIR (char)'d'
# define F_LINK (char)'l'

# define DEBUG printf

typedef struct			s_infosize
{
	int					name;
	int					blocks;
	int					links;
	int					uid;
	int					gid;
	int					size;
	int					t;
}						t_infosize;

typedef struct			s_entry
{
	int					init;
	struct s_file		*first;
	struct s_file		*file;
	int					count;
	int					max;
	char				*name;
	int					totalall;
	int					total;
	t_infosize			size;
	struct s_entry		*tmp_dir;
	int					recurs;
}						t_entry;

typedef struct			s_file
{
	char				*name;
	char				*date;
	time_t				millis;
	struct s_file		*next;
	struct s_file		*prev;
	struct dirent		*dirent;
	int					id;
	int					name_size;
}						t_file;

typedef struct			s_opt
{
	int					flag;
	int					error;
	char				*flags;
	struct s_entry		*entries;
	struct s_entry		*files;
	struct s_entry		*folders;
}						t_opt;

typedef struct			s_infos
{
	char				*name;
	char				*full_path;
	char				*mode;
	struct stat			stat;
	struct dirent		*dirent;
	struct passwd		*uid;
	struct group		*gid;
}						t_infos;

void					display_folder(t_opt *opt, t_entry *entry);
void					display(t_opt *opt, t_entry *entry);
int						can_print_next(t_opt *opt, t_file *file);
void					print_ls(t_opt *opt);

void					split_entries(t_opt *opt);
void					max_size(t_opt *opt);
void					update_entry_sizes(t_file *file, t_infosize *i, \
						char *str, struct stat pstat);

int						is_regular_file(const char *path);
int						is_folder(const char *path);
int						exist(const char *path);
char					*lsgetlink(char *path);
char					*get_path(char *parent, char *file);

void					free_entries(t_entry *entry);
void					free_file(t_file *file);
void					free_infos(t_infos *infos);
void					free_opt(t_opt *opt);

t_file					*new_file(char *name, struct dirent *dir);
void					add_file(t_entry *entry, char *str, \
						struct dirent *dir);
t_entry					*new_entry(void);
t_opt					*new_opt(void);
t_file					*get_file(t_file *first, int id);

int						bad_option(t_opt *opt, char option);
void					print_nexist(t_opt *opt, char *path);
int						exit_ftls(t_opt *opt);

int						set_flag(char c_flag, t_opt *opt);
int						parse(char **argv, t_opt *opt);
void					set_opt_folders(t_opt *opt, int argc, \
						char **argv, int index);

int						print(t_opt *opt, t_entry *entry, t_file *file, \
						t_infos *infos);
void					print_details(t_opt *opt, t_entry *entry, \
						t_file *file, t_infos *infos);
void					print_lnk(t_opt *opt, t_entry *entry, \
						t_file *file, t_infos *infos);
void					put_nbr(int nbr, int tab, int spaces, int max);
void					put(char *str, int tab, int spaces, int max);

t_infos					*get_infos(char *parent_path, char *path, \
						struct dirent *dirent);
void					read_folders(t_opt *opt, t_entry *entry, int ln);
void					add_for_recurs(t_entry *entry, t_file *file, \
						t_file *new);
void					recurs(t_opt *opt, t_entry *entry);
t_entry					*check_recurs(t_opt *opt, t_entry *entry);

void					swap(t_file *a, t_file *b);
void					sort(t_opt *opt, t_entry *entry, int low, int high);
void					sort_ascii(t_entry *entry, int low, int high);
void					sort_time(t_entry *entry, int low, int high);
int						compare(int t, t_file *f1, t_file *f2, int i);

char					*get_date(time_t date);

char					get_dtype(int type);
char					*get_color(int mode);
char					*get_mode(int mode);
int						has_flag(t_opt *opt, int flag);

#endif

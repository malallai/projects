/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:02:37 by malallai          #+#    #+#             */
/*   Updated: 2019/04/16 13:28:16 by malallai         ###   ########.fr       */
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
# include <errno.h>

# define F_DETAIL 1
# define F_RECURS 2
# define F_ALL 4
# define F_REVERSE 8
# define F_TIME 16
# define F_BLOCKS 32
# define F_UNSORT 64

# define WHITE (char *)"\033[0m"
# define CYAN (char *)"\033[1;36m"
# define RED (char *)"\033[0;31m"
# define PURPLE (char *)"\033[0;35m"

# define GREEN (char *)"\033[38;5;118m"
# define YELLOW (char *)"\033[38;5;226m"

# define F_DIR (char)'d'
# define F_LINK (char)'l'

# define DEBUG printf

/*
** Contain the hightest strlen of params (-l)
*/
typedef struct			s_infosize
{
	int					blocks;
	int					links;
	int					uid;
	int					gid;
	int					size;
	int					date;
}						t_infosize;

/*
** Contains informations about specific file
** char				*path: 		The path to file
** struct stat		file_stat:	Contain file stat (perm, mode etc..)
** struct passwd	uid: 		Owner (root)
** struct group		gid: 		Group (wheel)
** char				*date: 		Last modification date
** int				millis: 	Last modication in millis
** t_infosize		*sizes: 	See struct s_infosize -> link to struct s_folder
*/
typedef struct			s_infos
{
	char				*path;
	struct stat			file_stat;
	char				*perms;
	struct passwd		*uid;
	struct group		*gid;
	char				*date;
	int					millis;
	t_infosize			*sizes;
}						t_infos;

/*
** Chained list of files contain into s_folder
** int				id: 			Index of current file
** struct s_file	*next: 			Next link
** struct s_file	*prev: 			Previous link
** char				*path: 			Full path of file
** char				*clean_path:	Clean path of file (for -R option)
** t_infs			*infos: 		See struct s_infos
** int				exist: 			0|1 if file exist
*/
typedef struct			s_file
{
	int					id;
	struct s_file		*next;
	struct s_file		*prev;
	char				*name;
	char				*path;
	char				*clean_path;
	t_infos				*infos;
	int					exist;
}						t_file;

/*
** Folder
** t_file		*folder: 	struct s_file of current folder
** t_file		*first: 	First file of folder
** t_file		*file: 		Last file of folder
** t_infosize	*sizes: 	See s_infosize
** int			size: 		Total off file system blocks (exclude . | ..)
** int			size_all: 	Total of file system blocks (include . | ..)
** int			count: 		Number of file in folder
*/
typedef struct			s_folder
{
	t_file				*folder;
	t_file				*first;
	t_file				*file;
	t_infosize			*sizes;
	int					size;
	int					size_all;
	int					count;
}						t_folder;

/*
** int	flag:			flag sent by user
** int	error:			0|1 -> if error during execution
** int 	print:			If already print something
** char	*flags:			available flags
*/
typedef struct			s_opt
{
	int					flag;
	int					error;
	int					print;
	char				*flags;
	t_folder			*main;
}						t_opt;

/*
** files.c
** is_hidden_file:		return if file start with '.'
** is_parent:			return if file is . | ..
** can_print:			return if can print next file
** to_folder:			return if need to strjoin '/'
** get_file:			get indexed file in t_file
*/
int						is_hidden_file(char *str);
int						is_parent(char *str);
int						can_print(t_opt *opt, char *str);
int						to_folder(char *name, char *entry_name);
t_file					*get_file(t_file *first, int id);

/*
** free_ftls.c
*/
void					free_infos(t_infos *infos);
void					free_file(t_file *file);
void					free_folder(t_folder *folder);
void					free_opt(t_opt *opt);

/*
** ft_ls_exit.c
** bad_option:			when bad option is detected (-[laR...])
** print_nexist:		if a file is not found
** error_dir:			if error when reading dir & errno (ex: perm denied)
** exit_ftls:			exit ls with return statement and free
*/
int						bad_option(t_opt *opt, char option);
void					print_nexist(t_opt *opt, t_file *file);
void					error_dir(t_opt *opt, t_folder *folder, \
						int name);
void					print_error(t_opt *opt, t_file *file);
int						exit_ftls(t_opt *opt);

/*
** lst.c
** new_file:			init new t_file
** get_infos:			init new t_infos
** get_sizes:			update sizes
** new_size:			init new t_infosize
** new_folder:			init new t_folder from t_file
*/
t_file					*new_file(int id, char *name, t_folder *parent);
t_infos					*get_infos(t_file *file, t_folder *parent);
t_infosize				*get_sizes(t_infos *info, struct stat pstat, \
						t_infosize *parent);
t_infosize				*new_size(void);
t_folder				*new_folder(t_file *file);

/*
** opt.c
** init_opt:			init opt var
*/
t_opt					*init_opt(void);

/*
** parser.c
** set_flag:			add flag to bin opt->flag
** parse:				parse args sent by user (-lRar...)
** set_main_files:		parse file sent by user (ls ft_ls.c)
*/
int						set_flag(char c_flag, t_opt *opt);
int						parse(char **argv, t_opt *opt);
void					set_main_files(t_opt *opt, int argc, \
						char **argv, int index);

/*
** print_put.c
** put_lnk:				print infos if link file (ls -l)
** put_nbr:				print int using padding (ls -l)
** put_str:				print str using padding (ls -l)
*/
void					put_lnk(t_file *file);
void					put_nbr(int nbr, int tab, int spaces, int max);
void					put_str(char *str, int tab, int spaces, int max);

/*
** printer.c
** print_file:			print selected file
** print_folder:		print selected folder
** print_details:		print details of file (ls -l)
** print_lnk:			check if can print link (ls -l /tmp | ls -l /tmp/)
*/
int						print_file(t_opt *opt, t_file *file);
void					print_folder(t_opt *opt, t_folder *folder, int name);
int						print_details(t_opt *opt, t_file *file);
void					print_lnk(t_opt *opt, t_file *file);

/*
** reader.c
** read_folder:			read selected folder
** update_read_folder:	read selected folder (ouai 25 lignes tmtc)
** ls_folder:			ls for folder
** ls:					ls
*/
void					read_folder(t_opt *opt, t_folder *folder, int name);
void					update_read_folder(t_folder *folder, \
						t_file *tmp, int index);
void					ls_folder(t_opt *opt, t_file *file);
void					ls(t_opt *opt, t_file *file);

/*
** recurs.c
** recurs:				check if folder can be read inside folder (ls -R)
** get_clean_path:		get clean path for ls -lR
*/
void					recurs(t_opt *opt, t_folder *folder);
char					*get_clean_path(t_file *file1, t_file *file2);

/*
** sort.c
** sort:				sort t_folder
** sort_ascii:			sort as ascii
** sort_time:			sort as time
** compare:				compare two t_file for sort
*/
void					sort(t_opt *opt, t_folder *folder, int low, int high);
void					sort_ascii(t_folder *folder, int low, int high);
void					sort_time(t_folder *folder, int low, int high);
int						compare(int t, t_file *f1, t_file *f2, int i);

/*
** stat_ftls.c
** exist:				if file exist in disk
** lsgetlink:			return path of link (tmp -> private/tmp)
*/
int						is_regular_file(const char *path);
int						is_lnk(const char *path);
int						is_folder(const char *path);
int						exist(t_file *file);
char					*lsgetlink(char *path);

/*
** swap.c
** void	swap:			swap two file (@see struct s_file)
** void swap_item:		swap two item of file (@see struct s_file)
*/
void					swap(t_file *a, t_file *b);
void					swap_item(t_file **a, t_file *cpy);

/*
** time.c
** get_date:			return date into string (Apr 16 12:36 | Dec 10 2016)
*/
char					*get_date(time_t date);

/*
** utils.c
** get_type:			return type of file (l for lnk | d for dir..)
** get_color:			get color for typed file
** get_perms:			return perms for ls -l (-rwxr-xr-x)
** has_flag:			return if flag is in opt->flag (-lRar..)
*/
char					get_type(int mode);
char					*get_color(int mode);
char					*get_perms(int mode);
int						has_flag(t_opt *opt, int flag);

#endif
